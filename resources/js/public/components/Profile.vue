<template>
      <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                      v-bind:src="'storage/userpics/' + profile.imagePath "
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{profile.name}}</h3>

                

               

               
              </div>
              <!-- /.card-body -->
            </div>
</template>
<script>
export default {
    props:{
      
      profile: {type:Object}
  },
}
</script>