<template>
    <div :class="classes" @keyup.esc="cancel" tabindex="0">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Edit {{ data.name }}'s details </p>
                <button class="delete" aria-label="close" @click="cancel"></button>
            </header>
            <section class="modal-card-body">

                <!-- Content ... -->
                <div class="field">
                    <label for="">Name</label>
                    <div class="control">
                        <input v-model="data.name" :class="{'input': true, 'is-info': true, 'is-danger': errors.name}" type="text" placeholder="Name">
                    </div>
                    <ul v-if="errors.name">
                        <li v-for="error in errors.name">{{ error }}</li>
                    </ul>
                </div>
                <div class="field">
                    <label for="">Phone</label>
                    <div class="control">
                        <input v-model="data.phone" :class="{'input': true, 'is-info': true, 'is-danger': errors.phone}" type="text" placeholder="Phone">
                    </div>
                    <ul v-if="errors.phone">
                        <li v-for="error in errors.phone">{{ error }}</li>
                    </ul>
                </div>
                <div class="field">
                    <label for="">Email Address</label>
                    <div class="control">
                        <input v-model="data.email" :class="{'input': true, 'is-info': true, 'is-danger': errors.email}" type="text" placeholder="Email Address">
                    </div>
                    <ul v-if="errors.email">
                        <li v-for="error in errors.email">{{ error }}</li>
                    </ul>
                </div>


            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" @click="save">Save changes</button>
                <button class="button" @click="cancel">Cancel</button>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['active'],
        data () {
            return {
                data: {},
                errors: {},
            };
        },
        computed: {
            classes () {
                return {
                    modal: true,
                    'is-active': this.active
                }
            }
        },
        methods: {
            cancel () {
                this.$emit('cancel');
            },
            save () {
                axios
                    .patch(`/phonebook/${this.data.id}`, this.data)
                    .then(function (response) {

                        this.errors = {};
                        this.cancel();
                        this.edit(response);

                    }.bind(this))
                    .catch(function (error) {
                        if(error.response)
                        {
                            this.errors =  error.response.data.errors;
                        }

                    }.bind(this));
            },
            edit () {
                this.$emit('edited');
            }
        }
    }
</script>

<style scoped>
    ul li
    {
        padding: 3px 0 3px 10px;
        color: #ff5257;
        font-size: 13px;
    }
</style>