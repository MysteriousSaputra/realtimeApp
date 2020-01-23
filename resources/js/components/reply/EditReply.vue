<template>
    <div>
        <v-container>
            <vue-simplemde
            v-model="data.reply"
            ref="markdownEditor" />

            <v-btn
            color="success"
            class="mr-4"
            @click="updateReply"
            >
            update your answare
            </v-btn>

            <v-btn
            color="error"
            class="mr-4"
            @click="cancelEdit"
            >
            cancel
            </v-btn>

        </v-container>
    </div>
</template>

<script>
import VueSimplemde from 'vue-simplemde';

    export default {
        props:['data', 'index'],
        components: {
            VueSimplemde
        },
        data(){
            return {
                form:{
                    body:null
                }
            }
        },
        created(){
            // console.log(this.index, 'index')
        },
        methods:{
            cancelEdit(){
                EventBus.$emit('cancelEditReply', this.index)
            },
            updateReply(){
                axios.patch(`/api/quetion/${this.data.quetion_slug}/reply/${this.data.id}`, {body:this.data.reply})
                .then((result) => {
                    this.cancelEdit()
                }).catch((err) => {
                    console.error(err)
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
