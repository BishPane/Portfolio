<template>
  <div>
    <a href="/logout">Logout</a>

    <profile-editor :profile="profile" @getProfile="getProfile" />
    <portfolio-editor />
    <about-editor/>
    <social-media-editor/>
   
  </div>
</template>
<script>
import ProjectEditor from '../scratch/ProjectEditor.vue';
import AboutEditor from './components/AboutEditor.vue';
import PortfolioEditor from "./components/PortfolioEditor.vue";
import ProfileEditor from "./components/ProfileEditor";
import SocialMediaEditor from './components/SocialMediaEditor.vue';
export default {
  name: "AdminHome",

  components: { ProfileEditor, PortfolioEditor, AboutEditor, SocialMediaEditor, ProjectEditor },

  data() {
    return {
      profile: { type: Object },
    };
  },
  mounted() {
    this.getProfile();
  },
  created() {
    console.log("Profile: ", this.profile);
  },
  methods: {
    async getProfile() {
      const res = await this.callApi("get", "/getProfile");
      if (res.status == 200) {
        this.profile = res.data;
        console.log("PROFILE:", this.profile);
      }
    },
  },
};
</script>