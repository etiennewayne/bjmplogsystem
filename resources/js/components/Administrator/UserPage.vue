<template>
<div>
    <section class="section">


        <div class="panel">
            <div class="panel-heading">
                USERS
            </div>
            <div class="panel-body">
                <div class="level">
                    <div class="level-left">
                        <b-field label="Page">
                            <b-select v-model="perPage" @input="setPerPage">
                                <option value="5">5 per page</option>
                                <option value="10">10 per page</option>
                                <option value="15">15 per page</option>
                                <option value="20">20 per page</option>
                            </b-select>
                        </b-field>
                    </div>

                    <div class="level-right">
                        <div class="level-item">
                            <b-field label="Search">
                                <b-input type="text"
                                         v-model="search.lname" placeholder="Search Lastname"
                                         @keyup.native.enter="loadAsyncData"/>
                                <p class="control">
                                    <b-button type="is-primary" label="Search" @click="loadAsyncData"/>
                                </p>
                            </b-field>
                        </div>
                    </div>
                </div>

                <div class="buttons">
                    <b-button @click="openModal" type="is-success" icon-right="account">NEW USER</b-button>
                </div>

                <b-table
                    :data="data"
                    :loading="loading"
                    paginated
                    backend-pagination
                    :total="total"
                    :per-page="perPage"
                    @page-change="onPageChange"
                    aria-next-label="Next page"
                    aria-previous-label="Previous page"
                    aria-page-label="Page"
                    aria-current-label="Current page"
                    backend-sorting
                    :default-sort-direction="defaultSortDirection"
                    @sort="onSort">

                    <b-table-column field="id" label="ID" v-slot="props">
                        {{ props.row.user_id }}
                    </b-table-column>

                    <b-table-column field="username" label="Username" v-slot="props">
                        {{ props.row.username }}
                    </b-table-column>

                    <b-table-column field="name" label="Name" v-slot="props">
                        {{ props.row.lname }}, {{ props.row.fname}} {{ props.row.mname }}
                    </b-table-column>

                    <b-table-column field="sex" label="Sex" v-slot="props">
                        {{ props.row.sex }}
                    </b-table-column>

                    <b-table-column field="email" label="Email" v-slot="props">
                        {{ props.row.email }}
                    </b-table-column>

                    <b-table-column field="userType" label="Role" v-slot="props">
                        {{ props.row.role }}
                    </b-table-column>

                    <b-table-column field="ay_id" label="Action" v-slot="props">
                        <div class="is-flex">
                            <b-tooltip label="Edit" type="is-warning">
                                <b-button class="button is-small is-warning mr-1" tag="a" icon-right="pencil" @click="getData(props.row.user_id)"></b-button>
                            </b-tooltip>

                            <b-tooltip label="Reset password" type="is-danger">
                                <b-button class="button is-small is-danger mr-1" icon-right="delete" @click="confirmDelete(props.row.user_id)"></b-button>
                            </b-tooltip>

                            <b-tooltip label="Reset password">
                                <b-button class="button is-small is-link mr-1" icon-right="lock-reset" @click="openModalResetPassword(props.row.user_id)"></b-button>
                            </b-tooltip>
                            <b-tooltip label="User appointment(s)">
                                <b-button class="button is-small is-link mr-1" icon-right="view-list-outline" @click="openUserAppointments(props.row)"></b-button>
                            </b-tooltip>
                        </div>
                    </b-table-column>

                </b-table>
            </div>

        </div>
    </section>


    <!--modal create-->
    <b-modal v-model="isModalCreate" has-modal-card
             trap-focus
             :width="640"
             aria-role="dialog"
             aria-label="Modal"
             aria-modal>

        <form @submit.prevent="submit">
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">User Information</p>
                    <button
                        type="button"
                        class="delete"
                        @click="isModalCreate = false"/>
                </header>

                <section class="modal-card-body">
                    <div class="">
                        <div class="columns">
                            <div class="column">
                                <b-field label="Username" label-position="on-border"
                                        :type="this.errors.username ? 'is-danger':''"
                                        :message="this.errors.username ? this.errors.username[0] : ''">
                                    <b-input v-model="fields.username"
                                             placeholder="Username" required>
                                    </b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Last Name" label-position="on-border"
                                        :type="this.errors.lname ? 'is-danger':''"
                                        :message="this.errors.lname ? this.errors.lname[0] : ''">
                                    <b-input v-model="fields.lname"
                                             placeholder="Last Name" required>
                                    </b-input>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="First Name" label-position="on-border"
                                        :type="this.errors.fname ? 'is-danger':''"
                                        :message="this.errors.fname ? this.errors.fname[0] : ''">
                                    <b-input v-model="fields.fname"
                                             placeholder="First Name" required>
                                    </b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Middle Name" label-position="on-border"
                                        :type="this.errors.mname ? 'is-danger':''"
                                        :message="this.errors.mname ? this.errors.mname[0] : ''">
                                    <b-input v-model="fields.mname" placeholder="Middle Name">
                                    </b-input>
                                </b-field>
                            </div>

                            <div class="column">
                                <b-field label="Suffix" label-position="on-border"
                                        :type="this.errors.suffix ? 'is-danger':''"
                                        :message="this.errors.suffix ? this.errors.suffix[0] : ''">
                                    <b-input v-model="fields.suffix"
                                             placeholder="Suffix">
                                    </b-input>
                                </b-field>
                            </div>

                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Contact No" label-position="on-border"
                                        :type="this.errors.contact_no ? 'is-danger':''"
                                        :message="this.errors.contact_no ? this.errors.contact_no[0] : ''">
                                    <b-input type="number" v-model="fields.contact_no"
                                             placeholder="Contact No" required>
                                    </b-input>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="Email" label-position="on-border"
                                        :type="this.errors.email ? 'is-danger':''"
                                        :message="this.errors.email ? this.errors.email[0] : ''">
                                    <b-input type="email" v-model="fields.email"
                                             placeholder="Email" required>
                                    </b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns" v-if="global_id < 1">
                            <div class="column">
                                <b-field label="Password" label-position="on-border"
                                        :type="this.errors.password ? 'is-danger':''"
                                        :message="this.errors.password ? this.errors.password[0] : ''">
                                    <b-input type="password" password-reveal v-model="fields.password"
                                             placeholder="Password" required>
                                    </b-input>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="Confirm Password" label-position="on-border"
                                        :type="this.errors.password_confirmation ? 'is-danger':''"
                                        :message="this.errors.password_confirmation ? this.errors.password_confirmation[0] : ''">
                                    <b-input type="password" v-model="fields.password_confirmation" password-reveal
                                             placeholder="Confirm Password" required>
                                    </b-input>
                                </b-field>
                            </div>
                        </div>


                        <div class="columns">
                            <div class="column">
                                <b-field label="Sex" label-position="on-border" expanded
                                         :type="this.errors.sex ? 'is-danger':''"
                                         :message="this.errors.sex ? this.errors.sex[0] : ''">
                                    <b-select v-model="fields.sex" expanded>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </b-select>
                                </b-field>
                            </div>

                            <div class="column">
                                <b-field label="Role" label-position="on-border" expanded
                                         :type="this.errors.role ? 'is-danger':''"
                                         :message="this.errors.role ? this.errors.role[0] : ''"
                                >
                                    <b-select v-model="fields.role" expanded>
                                        <option value="ADMIN">ADMINISTRATOR</option>
                                        <option value="BJMP">BJMP</option>
                                        <option value="USER">USER</option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>


                        <div class="columns">
                            <div class="column">
                                <b-field label="Province" label-position="on-border" expanded
                                         :type="this.errors.province ? 'is-danger':''"
                                         :message="this.errors.province ? this.errors.province[0] : ''">
                                    <b-select v-model="fields.province" @input="loadCity" expanded>
                                        <option v-for="(item, index) in provinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                                    </b-select>
                                </b-field>
                            </div>

                            <div class="column">
                                <b-field label="City" label-position="on-border" expanded
                                         :type="this.errors.city ? 'is-danger':''"
                                         :message="this.errors.city ? this.errors.city[0] : ''">
                                    <b-select v-model="fields.city" @input="loadBarangay" expanded>
                                        <option v-for="(item, index) in cities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Barangay" label-position="on-border" expanded
                                         :type="this.errors.barangay ? 'is-danger':''"
                                         :message="this.errors.barangay ? this.errors.barangay[0] : ''">
                                    <b-select v-model="fields.barangay" expanded>
                                        <option v-for="(item, index) in barangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                                    </b-select>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="Street" label-position="on-border">
                                    <b-input v-model="fields.street"
                                             placeholder="Street" required>
                                    </b-input>
                                </b-field>
                            </div>
                        </div>
                    </div>

                </section>
                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="isModalCreate=false"/>
                    <button
                        :class="btnClass"
                        label="Save"
                        type="is-success">SAVE</button>
                </footer>
            </div>
        </form><!--close form-->
    </b-modal>
    <!--close modal-->




    <!-- reset password modal -->

    <!--modal create-->
    <b-modal v-model="isModalResetPassword" has-modal-card
             trap-focus
             :width="640"
             aria-role="dialog"
             aria-label="Modal"
             aria-modal>

        <form @submit.prevent="submitResetPassword">
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title"></p>
                    <button
                        type="button"
                        class="delete"
                        @click="isModalResetPassword = false"/>
                </header>

                <section class="modal-card-body">
                    <div class="">

                        <b-field label="Password" label-position="on-border"
                                 :type="this.errors.password ? 'is-danger':''"
                                 :message="this.errors.password ? this.errors.password[0] : ''">
                            <b-input v-model="fields.password" placeholder="Password">
                            </b-input>
                        </b-field>
                        <b-field label="Re-type Password" label-position="on-border"
                                 :type="this.errors.password_confirmation ? 'is-danger':''"
                                 :message="this.errors.password_confirmation ? this.errors.password_confirmation[0] : ''">
                            <b-input v-model="fields.password_confirmation"
                                     placeholder="Re-type Password">
                            </b-input>
                        </b-field>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="isModalResetPassword=false"/>
                    <button
                        :class="btnClass"
                        label="Save"
                        type="is-success">RESET PASSWORD</button>
                </footer>
            </div>
        </form><!--close form-->
    </b-modal>
    <!--close modal reset password-->




    <!--modal create-->
    <b-modal v-model="modalUserAppointment" has-modal-card
             trap-focus
             :width="640"
             aria-role="dialog"
             aria-label="Modal"
             aria-modal>

        <form @submit.prevent="submitResetPassword">
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{ fullname }}</p>
                    <button
                        type="button"
                        class="delete"
                        @click="modalUserAppointment = false"/>
                </header>

                <section class="modal-card-body">
                    <div class="">
                        <div class="level">
                            <div class="level-left">
                                <b-field label="Page">
                                    <b-select v-model="perPage" @input="setPerPageApp">
                                        <option value="5">5 per page</option>
                                        <option value="10">10 per page</option>
                                        <option value="15">15 per page</option>
                                        <option value="20">20 per page</option>
                                    </b-select>
                                </b-field>
                            </div>

                            <div class="level-right">
                                <div class="level-item">
                                    <b-field label="Search">
                                        <b-datepicker
                                                 v-model="search.appdate" placeholder="Search Lastname"/>
                                        <p class="control">
                                            <b-button type="is-primary" label="Search" @click="loadAsyncDataApp()"/>
                                        </p>
                                    </b-field>
                                </div>
                            </div>
                        </div>

                        <b-table
                            :data="dataApp"
                            :loading="loadingApp"
                            paginated
                            backend-pagination
                            :total="totalApp"
                            :per-page="perPageApp"
                            @page-change="onPageChangeApp"
                            aria-next-label="Next page"
                            aria-previous-label="Previous page"
                            aria-page-label="Page"
                            aria-current-label="Current page"
                            backend-sorting
                            :default-sort-direction="defaultSortDirectionApp"
                            @sort="onSortApp">

                            <b-table-column field="id" label="ID" v-slot="props">
                                {{ props.row.user_id }}
                            </b-table-column>

                            <b-table-column field="appointment_date" label="Appointment Date" v-slot="props">
                                {{ props.row.appointment_date }}
                            </b-table-column>

                            <b-table-column field="meridian" label="Meridian" v-slot="props">
                                {{ props.row.meridian }}
                            </b-table-column>

                            <b-table-column field="inmate" label="Inmate" v-slot="props">
                                {{ props.row.inmate }}
                            </b-table-column>

                            <b-table-column field="inmate_relationship" label="Relationship" v-slot="props">
                                {{ props.row.inmate_relationship }}
                            </b-table-column>
                        </b-table>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="modalUserAppointment=false"/>
                </footer>
            </div>
        </form><!--close form-->
    </b-modal>
    <!--close modal user appointment-->



</div>
</template>

<script>
export default {
    name: "UserPage",
    data(){
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'user_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 20,
            defaultSortDirection: 'asc',
            //table variables

            dataApp: [],
            totalApp: 0,
            loadingApp: false,
            sortFieldApp: 'appointment_id',
            sortOrderApp: 'desc',
            pageApp: 1,
            perPageApp: 20,
            defaultSortDirectionApp: 'asc',

            appointment: {},

            search: {
                lname: '',
            },

            fields: {},
            errors: {},
            global_id: 0,

            provinces: [],
            cities: [],
            barangays: [],
            street: '',

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

            isModalCreate: false,
            isModalResetPassword: false,
            modalUserAppointment: false,
        }
    },
    methods: {
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `lname=${this.search.lname}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-users?${params}`)
                .then(({ data }) => {
                    this.data = [];
                    let currentTotal = data.total
                    if (data.total / this.perPage > 1000) {
                        currentTotal = this.perPage * 1000
                    }

                    this.total = currentTotal
                    data.data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.data.push(item)
                    })
                    this.loading = false
                })
                .catch((error) => {
                    this.data = []
                    this.total = 0
                    this.loading = false
                    throw error
                })
        },
        onPageChange(page) {
            this.page = page
            this.loadAsyncData()
        },
        onSort(field, order) {
            this.sortField = field
            this.sortOrder = order
            this.loadAsyncData()
        },
        setPerPage(){
            this.loadAsyncData()
        },

        /*-----------USER APPOINTMENT------------*/
        loadAsyncDataApp() {

            let ndate = new Date(this.search.appdate);
            ndate = ndate.getFullYear() + '/' + (ndate.getMonth() + 1) +'/'+ ndate.getDate();
            const params = [
                `sort_by=${this.sortFieldApp}.${this.sortOrderApp}`,
                `appdate=${ndate}`,
                `perpage=${this.perPageApp}`,
                `page=${this.pageApp}`
            ].join('&')

            this.loadingApp = true
            axios.get(`/get-user-appointments/${this.appointment.user_id}?${params}`)
                .then(({ data }) => {
                    this.dataApp = [];
                    let currentTotal = data.totalApp
                    if (data.total / this.perPageApp > 1000) {
                        currentTotal = this.perPageApp * 1000
                    }

                    this.totalApp = currentTotal
                    data.data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.dataApp.push(item)
                    })
                    this.loadingApp = false
                })
                .catch((error) => {
                    this.dataApp = []
                    this.totalApp = 0
                    this.loadingApp = false
                    throw error
                })
        },
        onPageChangeApp(page) {
            this.pageApp = page
            this.loadAsyncDataApp()
        },
        onSortApp(field, order) {
            this.sortFieldApp = field
            this.sortOrderApp = order
            this.loadAsyncDataApp()
        },
        setPerPageApp(){
            this.loadAsyncDataApp()
        },

        /*-----------USER APPOINTMENT------------*/



        openModal(){
            this.isModalCreate=true;
            this.fields = {};
            this.errors = {};
        },

        loadProvince: function(){
            axios.get('/load-provinces').then(res=>{
                this.provinces = res.data;
            })
        },

        loadCity: function(){
            axios.get('/load-cities?prov=' + this.fields.province).then(res=>{
                this.cities = res.data;
            })
        },

        loadBarangay: function(){
            axios.get('/load-barangays?prov=' + this.fields.province + '&city_code='+this.fields.city).then(res=>{
                this.barangays = res.data;
            })
        },

        clearFields(){
            this.fields = {
                username: '',
                lname: '', fname: '', mname: '', suffix: '',
                password: '', password_confirmation : '',
                sex : '', role: '',  email : '', contact_no : '',
                province: '', city: '', barangay: '', street: ''
            };
        },

        //alert box ask for deletion
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this data?',
                cancelText: 'Cancel',
                confirmText: 'Delete user account?',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },
        //execute delete after confirming
        deleteSubmit(delete_id) {
            axios.delete('/users/' + delete_id).then(res => {
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;


                    if(this.errors.exist){
                        this.$buefy.dialog.alert({
                            title: 'CANNOT DELETE.',
                            message: this.errors.exist[0],
                            type: 'is-danger'
                        });
                    }
                }
            });
        },

        submit: function(){
            if(this.global_id > 0){
                //update
                axios.put('/users/'+this.global_id, this.fields).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: 'UPDATED!',
                            message: 'Successfully updated.',
                            type: 'is-success',
                            onConfirm: () => {
                                this.loadAsyncData();
                                this.clearFields();
                                this.global_id = 0;
                                this.isModalCreate = false;
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }else{
                //INSERT HERE
                axios.post('/users', this.fields).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: 'SAVED!',
                            message: 'Successfully saved.',
                            type: 'is-success',
                            confirmText: 'OK',
                            onConfirm: () => {
                                this.isModalCreate = false;
                                this.loadAsyncData();
                                this.clearFields();
                                this.global_id = 0;
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                });


            }
        },


        //update code here
        getData: function(data_id){
            this.clearFields();
            this.global_id = data_id;
            this.isModalCreate = true;


            //nested axios for getting the address 1 by 1 or request by request
            axios.get('/users/'+data_id).then(res=>{
                this.fields = res.data;
                let tempData = res.data;

                console.log(res.data);
                //load city first
                axios.get('/load-cities?prov=' + this.fields.province).then(res=>{
                    //load barangay
                    this.cities = res.data;
                    axios.get('/load-barangays?prov=' + this.fields.province + '&city_code='+this.fields.city).then(res=>{
                        this.barangays = res.data;
                        this.fields = tempData;
                    });
                });
            });
        },


        //---------RESET PASSWORD---------//

        openModalResetPassword(dataId){

            this.fields = {};
            this.isModalResetPassword = true;
            this.global_id = dataId;
        },

        submitResetPassword: function(){
            axios.post('/user-reset-password/' +this.global_id, this.fields).then(res=>{
                if(res.data.status === 'reseted'){
                    this.$buefy.dialog.alert({
                        title: 'RESET SUCCESSFULLY!',
                        message: 'Password reset successfully',
                        type: 'is-success',
                        onConfirm: ()=>{
                            this.fields = {};
                            this.global_id = 0;
                            this.loadAsyncData();
                            this.isModalResetPassword = false;
                        }
                    });
                }
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }
            })
        },

        openUserAppointments(row) {
            this.search.appdate = new Date();
            this.appointment = row;
            this.modalUserAppointment = true;
            this.loadAsyncDataApp();
        }

    },
    mounted() {
        this.loadAsyncData();
        this.loadProvince();
    },

    computed: {
        fullname(){
            return this.appointment.lname + ', ' + this.appointment.fname + ' ' + this.appointment.mname;
        }
    }
}
</script>

<style scoped>

</style>
