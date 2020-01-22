<template>
    <v-container>
        <v-form
        ref="form"
        v-model="valid"
        lazy-validation
        @submit.prevent="signup"
        >
            <v-text-field
            v-model="form.name"
            type="text"
            label="Name"
            required
            ></v-text-field>

            <v-text-field
            v-model="form.email"
            :rules="emailRules"
            type="email"
            label="E-mail"
            required
            ></v-text-field>

            <v-text-field
            v-model="form.password"
            :counter="10"
            :rules="passwordRules"
            type="password"
            label="Password"
            required
            ></v-text-field>

            <v-text-field
            v-model="form.confirmPassword"
            :counter="10"
            :rules="confirmPasswordRules"
            type="password"
            label="Confirm Password"
            required
            ></v-text-field>


            <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            type="submit"
            @click="validate"
            >
            Sign Up
            </v-btn>

    </v-form><br>

  <span style="text-align:center">Have an account? <router-link to="/login">Login here.</router-link></span>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      valid: true,
      password: '',
      passwordRules: [
        v => !!v || 'Password is required',
        v => (v && v.length <= 10) || 'Password must be less than 10 characters',
      ],
      confirmPassword: '',
      confirmPasswordRules: [
        v => !!v || 'Password confirmation is required',
        v => (v && v.length <= 10) || 'Password confirmation must be valid',
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      form:{
          email:null,
          password:null,
          name:null,
          confirmPassword:null
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
      signup(){
        axios.post('/api/auth/signup', this.form)
        .then((result) => {
          User.responseAfterLogin(result)
          this.$router.push({name:'forum'})
        }).catch((err) => {

        });
      }
    },
  }
</script>
<style lang="scss" scoped>

</style>
