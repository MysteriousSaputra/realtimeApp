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
                @submit.prevent="create"
                >
                <v-text-field
                v-model="form.title"
                type="text"
                label="Title"
                required
                autocomplete="off"
                ></v-text-field>

                <v-autocomplete
                    v-model="form.category_id"
                    :items="categories"
                    item-text="name"
                    item-value="id"
                    color="white"
                    label="Category"
                ></v-autocomplete>

                <vue-simplemde
                v-model="form.body"
                ref="markdownEditor" />

                <v-btn
                color="success"
                class="mr-4"
                type="submit"
                >
                Create
                </v-btn>
                </v-form>
            </v-container>
        </v-card>
 </div>
</template>

<script>
  import VueSimplemde from 'vue-simplemde';

    export default {
        components: {
        VueSimplemde
        },
        data () {
            return {
                form:{
                title:null,
                category_id:null,
                body:null
                },
                categories:{}
            }
        },
        created(){
            axios.get('/api/category')
            .then((result) => {
                // console.log(result.data.data)
                this.categories = result.data.data
            }).catch((err) => {

            });
        },
        methods:{
            create(){
                axios.post('/api/quetion', this.form)
                .then((result) => {
                    // console.log(result)
                    this.$router.push(result.data.path)
                }).catch((err) => {
                    console.error(err)
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
