<template>
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3 mb-lg-30">
            <h3 class="mb-0">Doanh thu</h3>
            <select v-model="mode" @change="fetchRevenue" class="form-select month-select form-control w-145">
              <option value="year">Theo năm</option>
              <option value="month">Theo tháng</option>
              <option value="day">Theo ngày</option>
            </select>
            <input
              v-if="mode === 'month' || mode === 'year'"
              type="number"
              v-model="selectedYear"
              min="2000"
              max="2100"
              class="border rounded p-2 w-24"
              placeholder="Năm"
              @change="fetchRevenue"
            />
          </div>

          <div style="margin: -5px -9px 0px -16px;">
            <div v-if="loading" class="text-center">Đang tải dữ liệu...</div>
            <Bar v-if="chartData" :data="chartData" :options="chartOptions" />
            <div v-if="error" class="text-red-500 text-center mt-4">{{ error }}</div>
          </div>
        </div>
      </div>

      <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-0">
          <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-4">
            <h3 class="mb-0">Danh sách khách hàng đã mua</h3>
          </div>

          <div class="default-table-area style-two recent-leads">
            <div class="table-responsive">
              <table class="table align-middle">
                <thead>
                  <tr>
                    <th scope="col">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" />
                      </div>
                    </th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gói</th>
                    <th scope="col">Ngày mua</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="customer in customers" :key="customer.user_id">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" />
                      </div>
                    </td>
                    <td class="fw-medium">{{ customer.user_name }}</td>
                    <td>{{ customer.email || 'N/A' }}</td>
                    <td>{{ customer.package }}</td>
                    <td>
                      <span class="badge bg-success bg-opacity-10 text-success p-2 fs-12 fw-normal">
                        {{ customer.order_date }}
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div v-if="customersError" class="text-red-500 text-center p-4">{{ customersError }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted } from 'vue';
import { Bar } from 'vue-chartjs';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
} from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const mode = ref('year'); // year | month | day
const selectedYear = ref(new Date().getFullYear());
const chartData = ref(null);
const loading = ref(true);
const error = ref('');

const customers = ref([]);
const customersError = ref('');

const chartOptions = {
  responsive: true,
  plugins: {
    legend: { display: false },
    title: { display: true, text: '', font: { size: 18 } },
  },
  scales: {
    y: { beginAtZero: true, title: { display: true, text: 'Tổng doanh thu (VNĐ)' } },
    x: { title: { display: true, text: '' } },
  },
};

const fetchRevenue = async () => {
  loading.value = true;
  error.value = '';
  customers.value = [];
  customersError.value = '';
  try {
    let revenueUrl = '';
    if (mode.value === 'year') {
      revenueUrl = '/api/revenue/year';
    } else if (mode.value === 'month') {
      revenueUrl = `/api/revenue/month?year=${selectedYear.value}`;
    } else {
      revenueUrl = '/api/revenue/day';
    }

    const revenueResponse = await fetch(revenueUrl);
    if (!revenueResponse.ok) throw new Error('Lỗi server doanh thu');
    const revenueData = await revenueResponse.json();

    let labels = [], revenues = [];

    if (mode.value === 'year') {
      labels = revenueData.map(item => item.year);
      revenues = revenueData.map(item => item.total_revenue);
      chartOptions.plugins.title.text = 'Tổng doanh thu theo năm';
      chartOptions.scales.x.title.text = 'Năm';
    } else if (mode.value === 'month') {
      labels = revenueData.map(item => `Th ${item.month}`);
      revenues = revenueData.map(item => item.total_revenue);
      chartOptions.plugins.title.text = `Tổng doanh thu theo tháng (${selectedYear.value})`;
      chartOptions.scales.x.title.text = 'Tháng';
    } else {
      labels = revenueData.map(item => item.date);
      revenues = revenueData.map(item => item.total_revenue);
      chartOptions.plugins.title.text = 'Tổng doanh thu theo ngày';
      chartOptions.scales.x.title.text = 'Ngày';
    }

    chartData.value = {
      labels,
      datasets: [
        {
          label: 'Doanh thu',
          data: revenues,
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
        },
      ],
    };

    await fetchCustomers();
  } catch (err) {
    error.value = 'Không thể tải dữ liệu doanh thu.';
    console.error(err);
  } finally {
    loading.value = false;
  }
};

const fetchCustomers = async () => {
  customersError.value = '';
  try {
    let url = `/api/revenue/customers-list?type=${mode.value}`;
    if (mode.value === 'day') {
      const today = new Date().toISOString().split('T')[0];
      url += `&date=${today}`;
    } else if (mode.value === 'month') {
      url += `&year=${selectedYear.value}&month=${new Date().getMonth() + 1}`;
    } else if (mode.value === 'year') {
      url += `&year=${selectedYear.value}`;
    }

    const response = await fetch(url);
    if (!response.ok) throw new Error('Lỗi server khi tải khách hàng');
    const data = await response.json();
    customers.value = data;
  } catch (err) {
    console.error(err);
    customersError.value = 'Không thể tải danh sách khách hàng.';
  }
};

onMounted(fetchRevenue);
</script>
