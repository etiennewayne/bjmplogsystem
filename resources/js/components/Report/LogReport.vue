<template>
    <div>

        <div class="section">
            <div class="">
                <div class="print-title">LOG REPORT</div>
            </div>

            <div class="nprint">
                <div class="columns is-centered">
                    <div class="column is-6">
                        <b-field label="From-To">
                            <b-datepicker v-model="search.dateFrom" ></b-datepicker>
                            <b-datepicker v-model="search.dateTo" ></b-datepicker>
                            <p class="control">
                                <button class="button is-link" @click="loadData">...</button>
                            </p>
                        </b-field>
                    </div>
                </div>
            </div>
            

            <div class="columns">
                <div class="column">
                    <div class="print printarea">
                        <table>
                            <thead>
                                <th>Appointment Date</th>
                                <th>Meridian</th>
                                <th>Inmate</th>
                                <th>Relationship</th>
                                <th>Frisk Item(s)</th>
                            </thead>
                            <tr v-for="(item, index) in data" :key="index">
                                <td>{{ item.appointment_date }}</td>
                                <td>{{ item.meridian }}</td>
                                <td>{{ item.inmate }}</td>
                                <td>{{ item.inmate_relationship }}</td>
                                <td>{{ item.frisking_items }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div><!--section-->
    </div> <!--root -->
</template>

<script>
export default {
    data(){
        return{
            data: [],

            search: {
                dateFrom: new Date(),
                dateTo: new Date(),
                dateStringFrom : '',
                dateStringTo: '',
            },
        }
    },
    methods: {
        loadData(){
            this.search.dateStringFrom = new Date(this.search.dateFrom).toLocaleDateString();
            this.search.dateStringTo = new Date(this.search.dateTo).toLocaleDateString();

            const param = [
                `datefrom=${this.search.dateStringFrom}`,
                `dateto=${this.search.dateStringTo}`
            ].join('&')

            axios.get(`/get-log-report?${param}`).then(res=>{
                this.data = res.data;
            })

        }
    },

}
</script>