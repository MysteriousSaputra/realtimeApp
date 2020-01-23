<template>
  <v-container class="grey lighten-5">
    <v-row no-gutters>
      <v-col
        cols="12"
        sm="8"
      >
       <quetion
       v-for="quetion in quetions"
       :key="quetion.path"
       :data=quetion
       ></quetion>
      </v-col>

      <v-col
        cols="12"
        sm="4"
      >
          <sidebar-forum></sidebar-forum>
      </v-col>


    </v-row>
  </v-container>
</template>

<script>
    import quetion from './Quetion';
    import SidebarForum from './SidebarForum';

    export default {
        data(){
            return {
                quetions:{}
            }
        },
        components:{
            quetion,
            SidebarForum
        },
        created(){
            axios.get('/api/quetion')
            .then((result) => {
                this.quetions = result.data.data
            }).catch((err) => {
                console.log(err)
            });
            // console.log(this.quetions)
        }
    }
</script>

<style lang="scss" scoped>

</style>
