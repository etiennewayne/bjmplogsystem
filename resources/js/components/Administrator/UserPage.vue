<template>
<div>
    <section class="section">
        <h1 class="title">USER PANEL</h1>

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
                    <b-button type="is-success" icon-right="account">NEW USER</b-button>
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
                            <b-button outlined class="button is-small is-warning mr-1" tag="a" icon-right="lead-pencil" @click="getData(props.row.id)">EDIT</b-button>
                            <b-button outlined class="button is-small is-danger mr-1" icon-right="delete" @click="confirmDelete(props.row.id)">DELETE</b-button>
                        </div>
                    </b-table-column>

                </b-table>
            </div>

        </div>
    </section>

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


            search: {
                lname: '',
            }
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
            axios.get(`/fetch-users?${params}`)
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

    },
    mounted() {
        this.loadAsyncData();
    }
}
</script>

<style scoped>

</style>
