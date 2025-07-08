<script setup>
import { onMounted, inject, ref } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const loading = ref(true);
const success = ref(false);
const error   = ref('');

const route       = useRoute();
const globalState = inject('globalState');
const baseUrl     = globalState.baseUrl;

onMounted(async () => {
  const code = route.query.code;
  if (!code) {
    loading.value = false;
    error.value = 'Không tìm thấy code trong URL.';
    return;
  }

  try {
    const { data } = await axios.post(
      `${baseUrl}/api/e-commerce/lazada/shop-access-token`,
      { code }
    );

    loading.value = false;

    if (data.status === true) {
      console.log('Đã ủy quyền thành công:', data);
      success.value = true;
    } else {
      error.value = data.message || 'Lỗi không xác định';
    }
  } catch (err) {          // ← đây!
    loading.value = false;
    console.error(err);
    error.value = err.response?.data?.message || err.message || 'Lỗi khi gọi API.';
  }
});
</script>
