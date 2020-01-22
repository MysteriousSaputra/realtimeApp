<template>
 <div>
        <v-card
            class="mx-auto"
            max-width="90%"
        >
            <v-container>
                <v-form
                ref="form"
                lazy-validation
                @submit.prevent="update"
                >
                <v-text-field
                v-model="form.title"
                type="text"
                label="Title"
                required
                autocomplete="off"
                ></v-text-field>

                <vue-simplemde
                v-model="form.body"
                ref="markdownEditor" />

                <v-btn
                color="success"
                class="mr-4"
                type="submit"
                >
                Update
                </v-btn>

                <v-btn
                color="error"
                class="mr-4"
                type="button"
                @click="cancel"
                >
                Cancel
                </v-btn>
                </v-form>
            </v-container>
        </v-card>
 </div>
</template>

<script>
  import VueSimplemde from 'vue-simplemde';

    export default {
        props:['data'],
        components: {
        VueSimplemde
        },
        data () {
            return {
                form:{
                title:null,
                body:null
                },
            }
        },
        created(){
           this.form = this.data;
        },
        methods:{
            cancel(){
                EventBus.$emit('cancelEditing');
            },
            update(){
                axios.put(`/api/quetion/${this.data.slug}`)
                .then((result) => {
                    this.cancel()
                }).catch((err) => {
                    console.log(err)
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
