<template>
    <div>

            <v-btn icon>
                <v-icon :color="color" @click="likeIt">mdi-heart</v-icon>
                <span class="subheading mr-2">{{count}}</span>
            </v-btn>
    </div>
</template>

<script>
    export default {
        props:['content']
        ,
        data(){
            return {
                liked:this.content.liked,
                count:this.content.like_count
            }
        },
        methods:{
            likeIt(){
                if (User.logedin()) {
                    this.liked ? this.unlike (): this.like();
                    this.liked = !this.liked
                }
            },
            like(){
                axios.post(`/api/like/${this.content.id}`)
                .then((result) => {
                    this.count ++
                }).catch((err) => {
                    console.error(err)
                });
            },
            unlike(){
                axios.delete(`/api/like/${this.content.id}`)
                .then((result) => {
                    this.count --
                }).catch((err) => {
                    console.error(err)
                });
            }
        },
        computed: {
            color(){
                return this.liked ? 'red' : 'white';
            }
        },
        created(){
            Echo.channel('likeChannel')
            .listen('LikeEvent', (e) => {
                if (this.content.id == e.id) {
                    e.type == 1 ? this.count ++ : this.count --;
                }
            });
        }

    }
</script>

<style lang="scss" scoped>

</style>
