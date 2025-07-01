<template>

    <!-- SUMMARY CARDS -->
    <div class="row justify-content-center mb-5">
      <!-- loading spinner -->
      <div class="col-12 text-center py-5" v-if="summaryLoading">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Đang tải…</span>
        </div>
      </div>
      <template v-else>
        <div class="col-sm-6 col-xxl-3 mb-4" v-for="(card, i) in cards" :key="i">
          <div class="card border-0 rounded-3 bg-white h-100">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
              <div class="d-flex mb-3">
                <div class="flex-grow-1">
                  <span class="d-block mb-1">{{ card.label }}</span>
                  <h4 class="fs-20 mb-0">
                    {{ card.isCurrency
                        ? formatCurrency(card.value)
                        : card.value
                    }}
                  </h4>
                </div>
                <div class="flex-shrink-0 ms-3">
                  <i :class="card.icon + ' fs-24 rounded-circle d-inline-block text-center'"
                     style="width:60px;height:60px;line-height:60px;background-color:#ECF0FF;"></i>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <span
                  class="d-inline-block px-3 rounded-pill fs-12 fw-medium"
                  :class="card.pct >= 0
                    ? 'bg-success bg-opacity-10 text-success border border-success'
                    : 'bg-danger bg-opacity-10 text-danger border border-danger'">
                  {{ (card.pct > 0 ? '+' : '') + card.pct + '%' }}
                </span>
                <span class="ms-2 fs-12">{{ card.subLabel }}</span>
              </div>
            </div>
          </div>
        </div>
      </template>
    </div>

    <!-- REVENUE CHART -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="card bg-white border-0 rounded-3">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
              <h3 class="mb-0">Doanh thu</h3>
              <div class="d-flex align-items-center gap-2">
                <select v-model="mode" @change="onModeChange" class="form-select w-auto">
                  <option value="year">Theo năm</option>
                  <option value="month">Theo tháng</option>
                  <option value="day">Theo ngày</option>
                </select>
                <input
                  v-if="mode==='month' || mode==='year'"
                  type="number"
                  v-model.number="selectedYear"
                  min="2000" max="2100"
                  class="form-control w-auto"
                  placeholder="Năm"
                  @change="onModeChange"
                />
              </div>
            </div>

            <div v-if="revenueLoading" class="text-center py-5">
              <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải biểu đồ…</span>
              </div>
            </div>

            <div v-else>
              <div v-if="revenueError" class="text-danger text-center mb-3">{{ revenueError }}</div>
              <Bar v-if="chartData" :data="chartData" :options="chartOptions" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CUSTOMERS TABLE WITH DATE FILTER -->
    <div class="row">
      <div class="col-12">
        <div class="card bg-white border-0 rounded-3">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h3 class="mb-0">Danh sách khách hàng đã mua</h3>
              <div class="d-flex align-items-center gap-2">
              <label class="mb-0">Từ:</label>
              <input type="date" v-model="fromDate" @change="onDateChange" class="form-control w-auto" />
              <label class="mb-0 ms-3">Đến:</label>
              <input type="date" v-model="toDate"   @change="onDateChange" class="form-control w-auto" />
            </div>
            </div>

            <div v-if="customersLoading" class="text-center py-5">
              <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải khách hàng…</span>
              </div>
            </div>

            <div class="default-table-area style-two transaction-history" v-else>
              <div v-if="customersError" class="text-danger text-center mb-3">{{ customersError }}</div>
              <div class="table-responsive" v-if="customers.length">
                <table class="table align-middle">
                  <thead>
                    <tr>
                      <th>Tên</th>
                      <th>Email</th>
                      <th>Công ty</th>
                      <th>Mã số thuế</th>
                      <th>Gói</th>
                      <th>Ngày mua</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="c in customers" :key="c.user_id">
                      <td class="fw-medium">{{ c.user_name }}</td>
                      <td>{{ c.email || '' }}</td>
                      <td>{{ c.companyName || '' }}</td>
                      <td>{{ c.companyTax || '' }}</td>
                      <td>{{ c.package }}</td>
                      <td>
                        <span>
                          {{ c.order_date }}
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div v-if="!customers.length && !customersError" class="text-center text-muted py-4">
                Không có dữ liệu khách hàng.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import { Bar }          from 'vue-chartjs';
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

// --- STATE ---
const summaryLoading   = ref(true);
const revenueLoading   = ref(true);
const customersLoading = ref(true);

const summary = reactive({
  total_revenue:         0,
  revenue_30_days:       0,
  pct_change_30_days:    0,
  monthly_revenue:       0,
  pct_change_monthly:    0,
  yearly_revenue:        0,
  pct_change_yearly:     0,
  new_users_30_days:     0,
  pct_change_users_30d:  0,
});

const mode          = ref('year');
const selectedYear  = ref(new Date().getFullYear());
const chartData     = ref(null);
const chartOptions  = reactive({
  responsive: true,
  plugins: {
    legend: { display: false },
    title: { display: true, text: '', font: { size: 18 } },
  },
  scales: {
    y: { beginAtZero: true, title: { display: true, text: 'Tổng doanh thu (VND)' } },
    x: { title: { display: true, text: '' } },
  },
});

const revenueError   = ref('');
const customers      = ref([]);
const customersError = ref('');

// date filters (default last 30 days)
const toDate   = ref(new Date().toISOString().slice(0,10));
const fromDate = ref(
  new Date(Date.now() - 29*24*60*60*1000)
    .toISOString().slice(0,10)
);

// --- CARDS COMPUTED ---
const cards = computed(() => [
  {
    label:      'Tổng doanh thu',
    value:      summary.total_revenue,
    pct:        summary.pct_change_30_days,
    subLabel:   'Trong 30 ngày',
    icon:       'ri-money-dollar-circle-line text-success',
    isCurrency: true,
  },
  {
    label:      'Doanh thu tháng',
    value:      summary.monthly_revenue,
    pct:        summary.pct_change_monthly,
    subLabel:   'So với tháng trước',
    icon:       'ri-shopping-bag-2-line text-primary',
    isCurrency: true,
  },
  {
    label:      'Doanh thu năm',
    value:      summary.yearly_revenue,
    pct:        summary.pct_change_yearly,
    subLabel:   'So với năm trước',
    icon:       'ri-currency-line text-primary',
    isCurrency: true,
  },
  {
    label:      'Người dùng mới',
    value:      summary.new_users_30_days,
    pct:        summary.pct_change_users_30d,
    subLabel:   'Trong 30 ngày',
    icon:       'ri-wallet-2-line text-primary',
    isCurrency: false,
  },
]);

const formatCurrency = (v) =>
  new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
    minimumFractionDigits: 0,
  }).format(v);

async function fetchSummary() {
  try {
    const res = await fetch('/api/revenue/totalOrder');
    if (!res.ok) throw new Error('dashboard API lỗi');
    const d = await res.json();
    Object.assign(summary, {
      total_revenue:        d.total_revenue,
      revenue_30_days:      d.revenue_30_days,
      pct_change_30_days:   d.pct_change_30_days,
      monthly_revenue:      d.monthly_revenue,
      pct_change_monthly:   d.pct_change_monthly,
      yearly_revenue:       d.yearly_revenue,
      pct_change_yearly:    d.pct_change_yearly,
      new_users_30_days:    d.new_users_30_days,
      pct_change_users_30d: d.pct_change_users_30d,
    });
  } catch (e) {
    console.error(e);
  } finally {
    summaryLoading.value = false;
  }
}

async function fetchRevenue() {
  revenueLoading.value = true;
  revenueError.value   = '';
  try {
    let url = mode.value === 'year'
      ? `/api/revenue/year`
      : mode.value === 'month'
        ? `/api/revenue/month?year=${selectedYear.value}`
        : `/api/revenue/day`;

    const res = await fetch(url);
    if (!res.ok) throw new Error('revenue API lỗi');
    const data = await res.json();

    // prepare chart
    let labels = [], vals = [];
    if (mode.value === 'year') {
      labels = data.map(i => i.year);
      vals   = data.map(i => i.total_revenue);
      chartOptions.plugins.title.text = 'Tổng doanh thu theo năm';
      chartOptions.scales.x.title.text = 'Năm';
    } else if (mode.value === 'month') {
      labels = data.map(i => `Th ${i.month}`);
      vals   = data.map(i => i.total_revenue);
      chartOptions.plugins.title.text = `Doanh thu ${selectedYear.value}`;
      chartOptions.scales.x.title.text = 'Tháng';
    } else {
      labels = data.map(i => i.date);
      vals   = data.map(i => i.total_revenue);
      chartOptions.plugins.title.text = 'Tổng doanh thu theo ngày';
      chartOptions.scales.x.title.text = 'Ngày';
    }

    chartData.value = {
      labels,
      datasets: [{ label:'Doanh thu', data:vals, backgroundColor:'rgba(54,162,235,0.6)' }]
    };
  } catch (e) {
    console.error(e);
    revenueError.value = 'Không thể tải dữ liệu doanh thu.';
  } finally {
    revenueLoading.value = false;
  }
}

async function fetchCustomers() {
  customersLoading.value = true;
  customersError.value   = '';
  try {
    // luôn dùng from…to
    let url = `/api/revenue/customers-list?from=${fromDate.value}&to=${toDate.value}`;
    const res = await fetch(url);
    if (!res.ok) throw new Error('customers API lỗi');
    customers.value = await res.json();
  } catch (e) {
    console.error(e);
    customersError.value = 'Không thể tải danh sách khách hàng.';
  } finally {
    customersLoading.value = false;
  }
}

function onModeChange() {
  fetchRevenue();
}

function onDateChange() {
  // đảm bảo from≤to
  if (fromDate.value > toDate.value) {
    [fromDate.value, toDate.value] = [toDate.value, fromDate.value];
  }
  fetchCustomers();
}

// --- LIFECYCLE ---
onMounted(async () => {
  await fetchSummary();
  fetchRevenue();
  fetchCustomers();
});
</script>

<style scoped>
.container { max-width: 1280px; }
.card { box-shadow: rgba(0,0,0,0.05) 0 1px 3px; }
</style>
