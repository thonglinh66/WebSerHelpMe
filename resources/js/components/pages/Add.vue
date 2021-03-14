<template>
<div class="content-wrapper">
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">From Create</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" @submit.prevent="addPost">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" v-model="datas.username" id="exampleInputEmail1" placeholder="Enter Username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password"  class="form-control" v-model="datas.password"  id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Repass</label>
                    <input type="password"  class="form-control" v-model="datas.repass"  id="exampleInputPassword2" placeholder="Password">
                  </div>
                  <div class="form-group">
                  <label>Minimal</label>
                  <select class="form-control select2" style="width: 100%;"  v-model="datas.type">                    
                    <option value="0">Customer</option>
                    <option value="1">Store</option>
                    <option value="2">Admin</option>
                  </select>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
   
            </div>
            <div class="col-md-6">
          </div>
        </div>
      </div>
    </section>
</div>
</template>
<script>
    export default {
        data(){
        return {
          datas:{
            type:0,
          },
          
        }
    },
    methods: {
        addPost(){
          if(this.datas.username == undefined || this.datas.password == undefined || this.datas.repass == undefined ||this.datas.type == undefined)
          {
             this.$toast.open({
                message: "Please Fill All data",
                type: "warning",
                duration: 1000,
                dismissible: true
              })
          }else{
            if(this.datas.password == this.datas.repass){
              let uri = 'http://127.0.0.1:8000/api/post/create';
              this.axios.post(uri, this.datas).then((response) => {
              this.$toast.open({
                message: response.data,
                type: "success",
                duration: 2000,
                dismissible: true
              })
              this.$router.push({path: '/home'});
              
              });
            }else{
                this.$toast.open({
                message: "Password incorrect",
                type: "error",
                duration: 1000,
                dismissible: true
              })
            }
          }
           
        },
    
    }
  }
</script>