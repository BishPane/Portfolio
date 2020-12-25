<template>
    
    
<div class="hold-transition login-page">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body ">
     

      <form action="#" method="post" @submit.prevent="login">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" v-model="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" v-model="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
         <p v-if="errors.length">{{errors}}</p>
        </div>
      </form>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

</div>

</template>

<script>
    export default {
        name: 'login',
        data() {
            return {
                email: '',
                password: '',
                errors:[]
            }

        },
        methods:{
            async login(){
                const res = await this.callApi('post','/login',{
                                                    email: this.email,
                                                    password: this.password,
                                                });
                if(res.status == 200){
                        console.log("LOGIN SUCCESS: ");
                        console.log(res.data);
                        // window.location = '/admin'
                         window['AuthCheck'] = 1;
                         this.$router.push({path: '/admin'});
                     }
              
                if(res.status == 422){
                   console.log(res.data);
                  this.errors = res.data.errors.email[0]
                }
            }
        }
    };
</script>

<style scoped>
    /* input {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    button {
        background-color: #101310;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    } */
    /* .login {
        width: 100vw;
        height: 100vh;
        background-color: #865ff3;
        display: flex;
        justify-content: center;
        align-items: center;
    } */
</style>