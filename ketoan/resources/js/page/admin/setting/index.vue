<template>
<div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-lg-4 mb-3">Thông tin cá nhân</h3>
                    <form>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Gói mặc định</label>
                                    <input type="text" class="form-control h-55" value="Alice">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Last Name</label>
                                    <input type="text" class="form-control h-55" value="Johnson">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Email Address</label>
                                    <input type="email" class="form-control h-55" value="johnson@trezo.com">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Phone Number</label>
                                    <input type="text" class="form-control h-55" value="+1 444 555 6699">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="d-flex flex-wrap gap-3">
                                    <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button>
                                    <button class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i class="ri-add-line text-white fw-medium"></i> Save Information</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>


<script>
export default {
    data() {
        return {
            userName: '',
            email: '',
            idUser: '',
            created_at: '',
            formattedDate: ''
        };
    },
    mounted() {
        const user = JSON.parse(localStorage.getItem('user'));
        if (user) {
            this.userName = user.name;
            this.email = user.email;
            this.idUser = user.id;
            this.created_at = user.created_at;
            const date = new Date(this.created_at);
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            this.formattedDate = `${day}-${month}-${year}`;
        }
    }
};
</script>
