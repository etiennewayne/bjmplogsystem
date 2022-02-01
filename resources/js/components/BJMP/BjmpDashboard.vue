<template>
<div>

    <div class="section">
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <div class="panel">
                    <div class="panel-heading">
                        NO OF VISITOR TODAY AS OF {{ new Date().toLocaleDateString() }}
                    </div>
                    <div class="panel-body">
                        <h1 class="title is-2 is-centered">{{count}}</h1>

                    </div>
                </div>
            </div>
        </div>
    </div> <!--section -->

</div> <!--root div -->

</template>

<script>
export default {
    props:{
        propCount:{
            type: String,
            default: ''
        }
    },

    data() {
        return {
            count: 0,
        }
    },

    methods:{
        initData(){
            this.count = parseInt(this.propCount);
        }
    },

    mounted(){
        this.initData();
    }
}

</script>
