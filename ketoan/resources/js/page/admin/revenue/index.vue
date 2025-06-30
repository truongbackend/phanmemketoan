<template>
  <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card bg-white border-0 rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3 mb-lg-30">
                                        <h3 class="mb-0">Doanh thu</h3>
                                        <select v-model="mode" @change="fetchRevenue" class="form-select month-select form-control w-145" aria-label="Default select example">
                                            <option value="year">Theo năm</option>
                                            <option value="month">Theo tháng</option>
                                            <option value="day">Theo ngày</option>
                                        </select>
                                        <input
                                        v-if="mode === 'month'"
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
  try {
    let url = '';
    if (mode.value === 'year') {
      url = '/api/revenue/year';
    } else if (mode.value === 'month') {
      url = `/api/revenue/month?year=${selectedYear.value}`;
    } else {
      url = '/api/revenue/day';
    }

    const response = await fetch(url);
    if (!response.ok) throw new Error('Lỗi server');
    const data = await response.json();

    let labels = [], revenues = [];

    if (mode.value === 'year') {
      labels = data.map(item => item.year);
      revenues = data.map(item => item.total_revenue);
      chartOptions.plugins.title.text = 'Tổng doanh thu theo năm';
      chartOptions.scales.x.title.text = 'Năm';
    } else if (mode.value === 'month') {
      labels = data.map(item => `Th ${item.month}`);
      revenues = data.map(item => item.total_revenue);
      chartOptions.plugins.title.text = `Tổng doanh thu theo tháng (${selectedYear.value})`;
      chartOptions.scales.x.title.text = 'Tháng';
    } else {
      labels = data.map(item => item.date);
      revenues = data.map(item => item.total_revenue);
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
  } catch (err) {
    error.value = 'Không thể tải dữ liệu doanh thu.';
    console.error(err);
  } finally {
    loading.value = false;
  }
};

onMounted(fetchRevenue);
</script>
