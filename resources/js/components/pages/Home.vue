<template>
<div class="content-wrapper">
<section class="content">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Account</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active">Account</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </section><!-- /.container-fluid -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="white-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <br>
                                 <router-link :to="{ path: '/create' }"  style="width:80px"  class="btn btn-success waves-effect waves-light m-r-10">Add </router-link>
                            <br>
                            <br>
                            <br>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">DataTable with default features</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div>
                                                    <vue-good-table
                                                    :columns="columns"
                                                    :rows="datas"  
                                                    :sort-options="{
                                                        enabled: true,
                                                        initialSortBy: {field: 'id', type: 'asc'}
                                                    }"                                                  
                                                    :search-options="{
                                                    enabled: true
                                                    }">
                                                        <template slot="table-row" slot-scope="props">
                                                            <span v-if="props.column.field == 'type'">
                                                            <span>{{ getText(props.row.type) }}</span>
                                                            </span>
                                                            <span v-else-if="props.column.field == 'function'">
                                                            <button class="btn btn-danger" @click.prevent="deletePost(props.row.id)">Delete</button>
                                                            </span>
                                                            <span v-else>
                                                            {{props.formattedRow[props.column.field]}}
                                                            </span>
                                                            <!-- <span v-if="props.column.field == 'type'">
                                                            <span v-if="props.row.type === 0" >Store</span>
                                                            <span v-if="props.row.type === 1" >Customer</span> 
                                                            <span v-if="props.row.type === 2" >Admin</span> 
                                                            </span>
                                                            <span v-if="props.column.field == 'function'">
                                                            <button class="btn btn-danger" @click.prevent="deletePost(props.row.id)">Delete</button>
                                                            </span>
                                                            <span v-else>
                                                            {{props.formattedRow[props.column.field]}}
                                                            </span> -->
                                                        </template>

                                                    </vue-good-table>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>
</div>
</template>

<script>
    import 'vue-good-table/dist/vue-good-table.css'
    import { VueGoodTable } from 'vue-good-table';

    // add to component
   
    
    export default {
        name: "Home",
        components: {
            VueGoodTable,
        },
        data() {
            return {
                 columns: [
                    {
                    label: 'ID',
                    field: 'id',
                    type: 'number',
                    width: '80px',
                    },
                    {
                    label: 'Username',
                    field: 'username',
                    },
                    {
                    label: 'Type',
                    field: 'type',
                    type: 'number',
                    },
                    {
                    label: 'Function',
                    field: 'function',
                    filterable: true
                    },
                ],
                datas: []
            }
        },
        created() {
            let uri = 'http://127.0.0.1:8000/api/home';
            this.axios.get(uri).then(response => {
                this.datas = response.data.data;

            });
        },
         methods: {
            deletePost(id)
            {
                let uri = `http://127.0.0.1:8000/api/post/delete/${id}`;
                this.axios.delete(uri).then(response => {
                this.datas.splice(this.datas.map(item => item.id).indexOf(id), 1);
                this.$toast.open({
                    message: response.data,
                    type: "success",
                    duration: 1000,
                    dismissible: true
                })
                });
            },
            getText(value) {
               if(value === 1)
               {
                   return 'Store';
               }
               else if(value === 0){
                   return 'Customer';
               }
               else if(value === 2)
               {
                   return 'Admin';
               }
               else{
                   return 'Defound';
               }
            }
         }
        
    };
</script>