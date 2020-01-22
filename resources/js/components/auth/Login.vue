<template>
  <v-container>
      <v-form
    ref="form"
    v-model="valid"
    lazy-validation
    @submit.prevent="login"
  >
    <v-text-field
      v-model="form.email"
      :rules="emailRules"
      type="email"
      label="E-mail"
      required
      autocomplete="off"
    ></v-text-field>

    <v-text-field
      v-model="form.password"
      :counter="10"
      :rules="passwordRules"
      type="password"
      label="Password"
      autocomplete="off"
      required
    ></v-text-field>


    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      type="submit"
      @click="validate"
    >
      Login
    </v-btn>

    <router-link to="/signup">
        <v-btn
      color="primary"
      class="mr-4"
    >
      Sign Up
    </v-btn>
    </router-link>

  </v-form>

  </v-container>
</template>

<script>
import ToolbarComponent from '../Toolbar';

  export default {
    data: () => ({
      valid: true,
      password: '',
      passwordRules: [
        v => !!v || 'Password is required',
        v => (v && v.length <= 10) || 'Password must be less than 10 characters',
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      form:{
          email:null,
          password:null
      },
    }),
    created(){
        if (User.logedin()) {
            this.$router.push({name:'forum'})
        }
    },
    methods: {
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
        }
      },
      reset () {
        this.$refs.form.reset()
      },
      resetValidation () {
        this.$refs.form.resetValidation()
      },
      login(){
        User.login(this.form);
        this.$router.push({name:'forum'});
        // this.renderToolbarComponent = true;
      }
    },
    components:{
        ToolbarComponent
    }
  }
</script>
<style lang="scss" scoped>

</style>
