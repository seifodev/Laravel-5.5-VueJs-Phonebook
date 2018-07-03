<template>
    <div :class="classes" @keyup.esc="cancel" tabindex="0">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add new phonebook</p>
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
                <button class="button is-success" @click="save">Save</button>
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
                data: {
                    name: '',
                    email: '',
                    phone: '',
                },
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
                    .post('/phonebook', {
                       name: this.data.name,
                       phone: this.data.phone,
                       email: this.data.email,
                    })
                    .then(function (response) {

                        for(let prop in this.data) {
                            this.data[prop] = '';
                        }
                        this.errors = {};
                        this.cancel();
                        this.add(response);

                    }.bind(this))
                    .catch(function (error) {
                        if(error.response)
                        {
                            this.errors =  error.response.data.errors;
                        }

                    }.bind(this));
            },
            add (response) {
                this.$emit('added', response);
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