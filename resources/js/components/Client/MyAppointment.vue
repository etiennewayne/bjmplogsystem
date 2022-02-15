<template>
<div>

    <div class="section">
        <div class="columns">
            <div class="column is-8 is-offset-2">
                <div class="panel">
                    <div class="panel-heading">
                        My Appointment
                    </div>
                    <div class="panel-body">

                        <div class="level">
                            <div class="level-left">
                                <div class="level-item">
                                    <b-field label="Page" label-position="on-border">
                                        <b-select v-model="perPage" @input="setPerPage">
                                            <option value="5">5 per page</option>
                                            <option value="10">10 per page</option>
                                            <option value="15">15 per page</option>
                                            <option value="20">20 per page</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="level-right">
                                <div class="level-item">
                                    <b-field label="Appointment Date" label-position="on-border">
                                        <b-datepicker v-model="mydateSearch" @keyup.native.enter="searchAppointment" placeholder="Appointment date..."></b-datepicker>
                                        <p class="control">
                                            <b-button type="is-link" icon-left="magnify" @click="searchAppointment"></b-button>
                                        </p>
                                    </b-field>
                                </div>
                            </div>

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

                            <b-table-column field="user_id" label="ID" v-slot="props">
                                {{ props.row.appointment_id }}
                            </b-table-column>

                            <b-table-column field="appointment_date" label="Appointment Date" v-slot="props">
                                {{ props.row.appointment_date }} ({{ props.row.meridian }})
                            </b-table-column>

                            <b-table-column field="inmate" label="Inmate" v-slot="props">
                                {{ props.row.inmate }}
                            </b-table-column>

                            <b-table-column field="is_approved" label="Approve" v-slot="props">
                                <span style="color: orange; font-weight: bold; font-size: small;" v-if="props.row.is_approved == 0">NO</span>
                                <span style="color: green; font-weight: bold; font-size: small;" v-else>APPROVED</span>
                            </b-table-column>

                            <b-table-column field="is_cancel" label="Cancel" v-slot="props">
                                <span style="color: orange; font-weight: bold; font-size: small;" v-if="props.row.is_cancel == 0">NO</span>
                                <span style="color: red; font-weight: bold; font-size: small;" v-else>CANCELLED</span>
                            </b-table-column>



                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">
<!--                                    <b-button class="button is-small is-warning mr-1" tag="a" icon-right="pencil" @click="getData(props.row.appointment_id)"></b-button>-->
                                    <b-button class="button is-small is-danger mr-1" icon-right="file-cancel-outline" @click="cancelAppointment(props.row.appointment_id)"></b-button>
                                </div>
                            </b-table-column>
                        </b-table>

                        <div class="buttons mt-4">
                            <b-button type="is-primary" tag="a" href="/" icon-left="book-plus">New</b-button>
                        </div>
                    </div> <!--panel -body-->
                </div>
            </div>
        </div>
    </div>



</div>

</template>


<script>
export default {
    data(){
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'appointment_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 5,
            defaultSortDirection: 'asc',

            mydateSearch: new Date(),

            global_id : 0,

            search: {
                appointment_date: null,
            },

            fields: {},
            errors: {},


            isModal: false,

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },


        }
    },
    methods:{
        /*
        * Load async data
        */
        loadAsyncData() {

            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `appointment_date=${this.search.appointment_date}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-appointments?${params}`)
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
        /*
        * Handle page-change event
        */
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

        openModal(){
            this.isModal = true;
            this.fields = {};
            this.errors = {};
        },

        getData: function(data_id){

            this.global_id = data_id;
            this.isModal = true;

            //nested axios for getting the address 1 by 1 or request by request
            axios.get('/my-appointment/'+ data_id).then(res=>{
                this.fields = res.data;
            });
        },

        //alert box ask for deletion
        cancelAppointment(data_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-warning',
                message: 'Are you sure you want to cancel your appointment?',
                cancelText: 'Close',
                confirmText: 'CANCEL APPOINTMENT?',
                onConfirm: () => this.cancelConfirm(data_id)
            });
        },
        //execute delete after confirming
        cancelConfirm(data_id) {
            axios.post('/my-appointment-cancel/' + data_id).then(res => {
                if(res.data.status === 'canceled'){
                    alert('Appointment canceled.');
                }
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

        searchAppointment: function(){
            let ndate = new Date(this.mydateSearch);

            this.search.appointment_date = ndate.getFullYear() + '-' + (ndate.getMonth() + 1) + '-' + ndate.getDate();
           // console.log(this.search.appointhis.loadAsyncData();
            this.loadAsyncData();
        }

    },
    mounted() {
        this.searchAppointment();

    }
}
</script>
