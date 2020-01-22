<template>

    <edit-quetion
    v-if="editing"
    :data=quetion>

    </edit-quetion>

    <div v-else>

        <show-quetion
        :data=quetion
        v-if="quetion">
        </show-quetion>

    </div>

</template>

<script>
import ShowQuetion from './ShowQuetion';
import EditQuetion from './EditQuetion';

    export default {
        data(){
            return{
                quetion:null,
                editing:false
            }
        },
        created(){
            this.getQuetion();
            this.listen();
        },
        components:{
            ShowQuetion,
            EditQuetion
        },
        methods:{
            getQuetion(){
                axios.get(`/api/quetion/${this.$route.params.slug}`)
                .then((result) => {
                    this.quetion = result.data.data
                }).catch((err) => {
                    // console.error(err);
                });
            },
            listen(){
                EventBus.$on('startEditing', () => {
                    this.editing = true
                })

                EventBus.$on('cancelEditing', () => {
                    this.editing = false
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
