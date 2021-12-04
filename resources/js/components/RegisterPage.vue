<template>

    <section class="p-4">

        <div class="columns">
            <div class="column is-8 is-offset-2">
                <div class="panel">
                    <div class="panel-heading">
                        REGISTER HERE
                    </div>

                    <div class="panel-body">
                        <div class="columns">
                            <div class="column">
                                <b-field label="Username">
                                    <b-input type="text" icon="account"></b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Password">
                                    <b-input type="password" icon="lock" password-reveal></b-input>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="Re-type Password">
                                    <b-input type="password" password-reveal></b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Email">
                                    <b-input type="email" icon="email"></b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Last Name">
                                    <b-input icon="account" type="text"></b-input>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="First Name">
                                    <b-input icon="account" type="text"></b-input>
                                </b-field>
                            </div>
                        </div>


                        <div class="columns">
                            <div class="column">
                                <b-field label="Middle Name">
                                    <b-input type="text"></b-input>
                                </b-field>
                            </div>

                            <div class="column">
                                <b-field label="Suffix">
                                    <b-input type="text" placeholder="Suffix"></b-input>
                                </b-field>
                            </div>

                            <div class="column is-3">
                                <b-field label="Sex" expanded>
                                    <b-select placeholder="Sex" icon="account" expanded>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Province" expanded>
                                    <b-select expanded></b-select>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="City/Municipality" expanded>
                                    <b-select expanded></b-select>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Barangay" expanded>
                                    <b-select expanded></b-select>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="House #. Street">
                                    <b-input type="text"></b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="buttons is-right">
                            <b-button type="is-success">Register</b-button>
                        </div>

                    </div><!--panel body-->

                </div>
            </div>
        </div>


    </section>
</template>

<script>

</script>
