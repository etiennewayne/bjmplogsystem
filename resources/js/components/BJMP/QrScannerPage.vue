<template>
    <div>

        <div class="section">
            <div class="camera">
                <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit">
<!--                    <div v-if="validationSuccess" class="validation-success">-->
<!--                        Scanned successfully.-->
<!--                        <img :src="`/storage/imgs/${user.img_path}`"/>-->
<!--                    </div>-->

                    <div v-if="validationFailure" class="validation-failure">
                        {{ remark }}
                    </div>

                    <div v-if="validationPending" class="validation-pending">
                        Processing...
                    </div>
                </qrcode-stream>
            </div>

            <p class="decode-result">QR Code: <b>{{ result }}</b></p>

            <div class="buttons mt-1 is-centered">
                <b-button @click="turnCameraOn" label="TURN ON"></b-button>
                <b-button @click="turnCameraOff" label="TURN OFF"></b-button>
            </div>
        </div>
        <!--section -->


        <!--modal create-->
        <b-modal v-model="isModalValidModal" has-modal-card
                 trap-focus
                 :width="640"
                 scroll="clip"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>


            <div class="modal-card">
                <form @submit.prevent="submit">
                    <header class="modal-card-head">
                        <p class="modal-card-title">SCANNED INFORMATION</p>
                        <button
                            type="button"
                            class="delete"
                            @click="isModalValidModal = false"/>
                    </header>

                    <section class="modal-card-body" style="overflow: auto;">
                        <div class="">
                            <div class="columns">
                                <div class="column">
                                    <div style="border: 1px solid #cbcbcb;">
                                        <img :src="`/storage/imgs/${user.user.img_path}`" class="visitor-img"/>
                                    </div>
                                </div>

                                <div class="column">
                                    <p><b>Name:</b> {{ user.user.lname }}, {{ user.user.fname }} {{ user.user.mname }}</p>
                                    <p><b>Visit Schedule:</b> {{ user.appointment_date }}, {{ user.meridian }}</p>
                                    <p><b>Relationship: </b> {{ user.inmate_relationship }}</p>
                                    <p><b>Inmate to visit: </b> {{ user.inmate }}</p>

                                    <div class="companion">
                                        <h1 class="title is-6">COMPANION(S)</h1>
                                        <ul>
                                            <li v-for="(item, index) in user.companions" :key="index"> {{ item.fullname }} - {{ item.inmate_relationship }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="title is-6">Frisk Item(s)</h3>
                            <div class="frisk-item-wrapper">
                                <b-field v-for="(item, index) in this.fields.friskItems" :key="index" expanded>
                                    <b-input expanded v-model="item.item_name" type="text" placeholder="Item Name"></b-input>
                                    <p class="controls">
                                        <b-button type="is-danger" @click="remove(index)" icon-left="trash-can"></b-button>
                                    </p>
                                </b-field>
                                <div class="buttons is-right">
                                    <b-button @click="add" type="is-success" class="is-small" icon-left="plus">ADD</b-button>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="isModalValidModal=false"/>
                        <button
                            class="button is-success">SAVE</button>
                    </footer>
                </form>
            </div>

        </b-modal>
        <!--close modal-->


    </div><!--root-->

</template>



<script>
export default {
    data(){
        return{
            user: {
                user: {},
                companions: {}
            },
            isValid: undefined,
            camera: 'off',
            result: null,
            isProcessing: false,

            isModalValidModal: false,

            fields: {
                friskItems: [],
            },

            remark: '',
        }
    },
    methods: {
        onInit (promise) {
            promise
                .catch(console.error)
                .then(this.resetValidationState)
        },

        resetValidationState () {
            this.isValid = undefined
        },

        async onDecode (content) {
            //console.log(content);
            this.result = content;
            this.turnCameraOff();

            // pretend it's taking really long
            this.isProcessing = true;
            //await this.timeout(3000);
            axios.get('/validate-qr/' +content).then(res=>{
                if(res.data.status === 'ok'){
                    console.log(res.data.data);
                    this.user = res.data.data;
                    this.isProcessing = false;
                    this.isValid = true;
                    this.isModalValidModal = true;
                   console.log(res.data);
                }else{
                    this.isProcessing = false;
                    this.isValid = false;
                }
            }).catch(err=>{
                this.isProcessing = false;
                console.log(err.response.data.status);

                if(err.response.data.status === 'invalid'){
                    this.remark = 'INVALID QR.';
                    this.isValid = false;
                }

                if(err.response.data.status === 'scanned'){
                    this.remark = 'ALREADY SCANNED!';
                    this.isValid = false;
                }

            })
            //this.isValid = content.startsWith('http') //this will return boolean value

            // some more delay, so users have time to read the message
            await this.timeout(2000);
            this.turnCameraOn()
        },

        turnCameraOn () {
            this.camera = 'auto';
        },

        turnCameraOff () {
            this.camera = 'off'
        },

        timeout (ms) {
            return new Promise(resolve => {
                window.setTimeout(resolve, ms)
            })
        },

        submit: function(){
            axios.post('/save-frisk-item/' + this.user.appointment_id, this.fields).then(res=>{
                if(res.data.status === 'saved'){
                    this.isModalValidModal = false;
                    this.$buefy.toast.open({
                        message: 'Frisk item save successfully.',
                        type: 'is-success'
                    });

                    this.fields = {
                        friskItems: [],
                    };
                }
            })
        },

        add () {
            this.fields.friskItems.push({
                item_name: '',
            })
        },
        remove(index){
            //alert(index);
            this.fields.friskItems.splice(index, 1);
        },

    },

    computed: {
        validationPending() {
            return this.isProcessing;
        },

        validationSuccess() {

            return this.isValid === true
        },

        validationFailure() {
            return this.isValid === false
        },
    },
}
</script>

<style scoped>
.validation-success,
.validation-failure,
.validation-pending {
    position: absolute;
    width: 100%;
    height: 100%;

    background-color: rgba(255, 255, 255, .8);
    text-align: center;
    font-weight: bold;
    font-size: 1.4rem;
    padding: 10px;

    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
}
.validation-success {
    color: green;
}
.validation-failure {
    color: red;
}

.camera{
    margin: auto;
    width: 240px;
    height: 320px;
    border: 1px solid gray;
}

.decode-result{
    text-align: center;
}




.visitor-img{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;

}

.companion{
    margin: 15px 0 10px 25px;
}

.frisk-item-wrapper{
    max-height: 200px;
    overflow: auto;
}
</style>
