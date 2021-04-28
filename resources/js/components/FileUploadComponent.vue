<template>
    <v-container fluid>
      <v-file-input
        v-model="files"
    multiple
    label="File input"
  ></v-file-input>
   <v-btn @click="fileUpload()" block>
   guardar
  </v-btn>
    </v-container>
</template>

<script>
  const axios = require('axios');
  
    export default {
      mounted(){
   

   },
    data () {
      return {
      files:[],
      }
    },
     methods: {
     async fileUpload(){
      let formData = new FormData()
      if(this.files.length != 0){
         
                        for(let i = 0; i < this.files.length; i++){
                            let file = this.files[i]
                            formData.append('archivo['+i+']',file)
                        }
                      }
                      const response = await axios({
                        method: 'post',
                        url: 'upload',
                        data:formData
                        })
                      console.log("ok")


     },
     },
  }
</script>
