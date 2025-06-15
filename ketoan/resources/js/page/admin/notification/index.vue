<template>
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Thông báo</h3>

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Trang chủ</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Thông báo</span>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="default-table-area all-products">
                    <div v-if="loading" class="text-center p-5">Loading notifications...</div>
                    <div v-if="error" class="alert alert-danger">{{ error }}</div>
                    <div v-if="!loading && !notifications.length" class="text-center p-5">No notifications found.</div>

                    <div v-if="!loading && notifications.length" class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="notification in notifications" :key="notification.id">
                                    <td class="text-body">{{ notification.display_id }}</td>
                                    <td class="text-body">{{ notification.timestamp_formatted }}</td>
                                    <td class="text-secondary fw-medium">{{ notification.type }}</td>
                                    <td class="text-secondary fw-medium">{{ notification.content }}</td>
                                    <td>
                                        <span :class="['badge', notification.is_read ? 'bg-primary bg-opacity-10 text-primary' : 'bg-danger bg-opacity-10 text-danger', 'p-2', 'fs-12', 'fw-normal']">
                                            {{ notification.is_read ? 'Đã đọc' : 'Chưa đọc' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <button @click="markAsRead(notification.id)" class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" title="Mark as Read">
                                                <i class="material-symbols-outlined fs-16 text-primary">visibility</i>
                                            </button>
                                            <button @click="deleteNotification(notification.id)" class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" title="Delete">
                                                <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                        <span class="fs-13 fw-medium">Items per pages: {{ pagination.perPage }}</span>

                        <div class="d-flex align-items-center">
                            <span class="fs-13 fw-medium me-2">{{ showingText }}</span>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mb-0 justify-content-center">
                                    <li class="page-item" :class="{ 'disabled': pagination.currentPage === 1 }">
                                        <a class="page-link icon" href="#" @click.prevent="goToPage(pagination.currentPage - 1)" aria-label="Previous">
                                            <i class="material-symbols-outlined">keyboard_arrow_left</i>
                                        </a>
                                    </li>
                                    <li class="page-item" v-for="page in pagination.lastPage" :key="page" :class="{ 'active': page === pagination.currentPage }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(page)">{{ page }}</a>
                                    </li>
                                    <li class="page-item" :class="{ 'disabled': pagination.currentPage === pagination.lastPage }">
                                        <a class="page-link icon" href="#" @click.prevent="goToPage(pagination.currentPage + 1)" aria-label="Next">
                                            <i class="material-symbols-outlined">keyboard_arrow_right</i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            // Stores the list of notifications fetched from the API
            notifications: [],
            // Holds pagination details like total items, current page, etc.
            pagination: {
                total: 0,
                perPage: 10, // Default items per page
                currentPage: 1,
                lastPage: 1,
                from: 0,
                to: 0,
            },
            // Loading state indicator for UI feedback
            loading: true,
            // Stores any error messages during API calls
            error: null,
            // Base URL for your Laravel API. **Remember to change this to your actual API endpoint.**
            apiBaseUrl: 'http://127.0.0.1:8000/api',
        };
    },
    computed: {
        /**
         * Computes the display text for "Showing X - Y of Z items".
         */
        showingText() {
            if (this.pagination.total === 0) {
                return 'No items';
            }
            return `${this.pagination.from} - ${this.pagination.to} of ${this.pagination.total}`;
        }
    },
    methods: {
        /**
         * Fetches notifications from the Laravel API.
         * @param {number} page The page number to fetch. Defaults to 1.
         */
        async fetchNotifications(page = 1) {
            this.loading = true; // Set loading to true before fetching
            this.error = null; // Clear any previous errors

            try {
                const response = await axios.get(`${this.apiBaseUrl}/notifications`, {
                    params: {
                        page: page,
                        per_page: this.pagination.perPage // Use the component's perPage setting
                    }
                });

                // Map the incoming data to include formatted timestamp and a display ID
                this.notifications = response.data.data.map(notification => ({
                    ...notification,
                    // Format the timestamp to match your template's style (e.g., "01 Dec 2024 09:30 AM")
                    timestamp_formatted: new Date(notification.timestamp).toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    }) + ' ' + new Date(notification.timestamp).toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    }),
                    // Create a display ID like #JAN-854 (adjust logic if your backend provides this directly)
                    display_id: `#JAN-${String(notification.id).padStart(3, '0')}`
                }));

                // Update pagination data based on the API response
                this.pagination.total = response.data.total;
                this.pagination.perPage = response.data.per_page;
                this.pagination.currentPage = response.data.current_page;
                this.pagination.lastPage = response.data.last_page;
                this.pagination.from = response.data.from;
                this.pagination.to = response.data.to;

            } catch (err) {
                console.error("Error fetching notifications:", err);
                this.error = "Failed to fetch notifications. Please try again later.";
            } finally {
                this.loading = false; // Set loading to false after fetch completes (success or error)
            }
        },
        /**
         * Marks a specific notification as read in the backend and updates the local state.
         * @param {number} notificationId The ID of the notification to mark as read.
         */
        async markAsRead(notificationId) {
            try {
                await axios.put(`${this.apiBaseUrl}/notifications/${notificationId}/mark-as-read`);
                // Find the notification in the local array and update its status
                const index = this.notifications.findIndex(n => n.id === notificationId);
                if (index !== -1) {
                    this.notifications[index].is_read = true;
                }
                // Optionally, show a success message
                // alert("Notification marked as read!");
            } catch (err) {
                console.error("Error marking notification as read:", err);
                alert("Failed to mark notification as read. Please try again.");
            }
        },
        /**
         * Deletes a specific notification from the backend and removes it from the local list.
         * @param {number} notificationId The ID of the notification to delete.
         */
        async deleteNotification(notificationId) {
            if (!confirm('Are you sure you want to delete this notification?')) {
                return; // User cancelled the deletion
            }
            try {
                await axios.delete(`${this.apiBaseUrl}/notifications/${notificationId}`);
                // Remove the deleted notification from the local array
                this.notifications = this.notifications.filter(n => n.id !== notificationId);
                // Re-fetch to ensure pagination counts and display are correct after deletion
                this.fetchNotifications(this.pagination.currentPage);
                // Optionally, show a success message
                // alert("Notification deleted successfully!");
            } catch (err) {
                console.error("Error deleting notification:", err);
                alert("Failed to delete notification. Please try again.");
            }
        },
        /**
         * Navigates to a specific page of notifications.
         * @param {number} page The page number to navigate to.
         */
        goToPage(page) {
            if (page >= 1 && page <= this.pagination.lastPage) {
                this.fetchNotifications(page);
            }
        }
    },
    /**
     * Lifecycle hook: Called after the component has been mounted to the DOM.
     * Initiates the fetching of notifications.
     */
    mounted() {
        this.fetchNotifications();
    }
};
</script>
