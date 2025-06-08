import { reactive } from 'vue';
const globalState = reactive({
  baseUrl: 'http://127.0.0.1:8000',
});
export default globalState;
