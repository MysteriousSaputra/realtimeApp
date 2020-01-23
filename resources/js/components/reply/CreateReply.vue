<template>
 <div>
        <v-card
            class="mx-auto"
            max-width="90%"
        >
            <v-container>
                <v-form
                ref="form"
                @submit.prevent="postReply"
                lazy-validation
                >

                <vue-simplemde
                v-model="form.body"
                ref="markdownEditor" />

                <v-btn
                color="success"
                class="mr-4"
                type="submit"
                >
                post your answare
                </v-btn>
                </v-form>
            </v-container>
        </v-card>
 </div>
</template>

<script>
  import VueSimplemde from 'vue-simplemde';

    export default {
        props:['quetionSlug'],
        components: {
        VueSimplemde
        },
        data(){
            return {
                form:{
                    body:null,
                }
            }
        },
        methods:{
            postReply(){

                axios.post(`/api/quetion/${this.quetionSlug.slug}/reply`, this.form)
                .then((result) => {
                    this.form.body = ''
                    EventBus.$emit('createReply', result.data.reply)
                    // console.log(result, 'result')
                }).catch((err) => {
                    console.error(err)
                });
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
