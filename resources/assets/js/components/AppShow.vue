<template>
    <div :class="classes" @keyup.esc="cancel" tabindex="0">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Phonebook</p>
                <button class="delete" aria-label="close" @click="cancel"></button>
            </header>
            <section class="modal-card-body">

                <!-- Content ... -->

                <div class="panel-block">
                    <span class="column is-2">
                    <strong>Name: </strong>
                    </span>
                        <span class="column is-10">
                        <span v-text="data.name"></span>
                    </span>
                </div>
                <div class="panel-block">
                    <span class="column is-2">
                    <strong>Phone: </strong>
                    </span>
                    <span class="column is-10">
                        <span v-text="data.phone"></span>
                    </span>
                </div>
                <div class="panel-block">
                    <span class="column is-2">
                    <strong>Email: </strong>
                    </span>
                    <span class="column is-10">
                        <span v-text="data.email"></span>
                    </span>
                </div>


            </section>
            <footer class="modal-card-foot">
                <button class="button" @click="cancel">Close</button>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['active'],
        data () {
            return {
                data: false,
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
        }
    }
</script>

<style scoped>

</style>