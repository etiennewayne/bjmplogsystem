<template>
    <div>

        <div class="section">


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
                        <div class="header-area">
                            <div class="header-left">
                                <img class="img-left" src="/img/bjmp.png">
                            </div>
                            <div class="header-phrase">
                                <div style="font-weight: bold;">BUREAU OF JAIL MANAGEMENT AND PENOLOGY</div>
                                <div style="">TANGUB CITY JAIL</div>
                                <div style="">BRGY. STA. CRUZ, TANGUB CITY</div>
                            </div>
                            <div class="header-right">
                                <img class="img-right" src="/img/dilg_logo.svg">
                            </div>
                        </div>

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

                        <div class="signatory-area">
                            <div style="font-weight: bold;">APPROVED BY:</div>
                            <div class="sign-name-area">
                                <div class="sign-name">RANK SHIELA G. CONOL</div>
                                <div style="text-align: center;">POSITION</div>
                            </div>

                        </div>
                    </div><!--print area-->
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

<style scoped>
    .header-area{
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
    }


    .img-left, .img-right{
        height: 100px;
    }

    .header-phrase{
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .signatory-area{
        margin-top: 100px;
        margin-left: 100px;
    }

    .sign-name-area{
        margin-top: 100px;
        width: 200px;
    }
    .sign-name{
        font-weight: bold;
        border-bottom: 1px solid black;
    }
</style>
