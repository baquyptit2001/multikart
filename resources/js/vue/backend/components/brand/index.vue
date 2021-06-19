<template>
    <span>
        <side-bar/>
        <head-top/>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <el-dialog title="Thêm nhãn hiệu" :visible.sync="addBrandForm">
                <el-form :model="form">
                    <el-form-item label="Tên nhãn hiệu" :label-width="formLabelWidth">
                        <el-input v-model="form.name" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Ảnh nhãn hiệu" :label-width="formLabelWidth">
                        <el-input v-model="form.image" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Trạng thái" :label-width="formLabelWidth">
                        <el-tooltip content="Ẩn/Hiện" placement="top">
                            <el-switch
                                v-model="form.status"
                                active-value="1"
                                inactive-value="0">
                            </el-switch>
                        </el-tooltip>
                    </el-form-item>
                </el-form>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="addBrandForm = false">Cancel</el-button>
                    <el-button type="primary" @click="addItem()">Confirm</el-button>
                </span>
                </el-dialog>
                <el-dialog title="Thêm nhãn hiệu" :visible.sync="editBrandForm">
                <el-form :model="form">
                    <el-form-item label="Tên nhãn hiệu" :label-width="formLabelWidth">
                        <el-input v-model="editForm.name" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Ảnh nhãn hiệu" :label-width="formLabelWidth">
                        <el-input v-model="editForm.image" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Trạng thái" :label-width="formLabelWidth">
                        <el-tooltip content="Ẩn/Hiện" placement="top">
                            <el-switch
                                v-model="editForm.status"
                                active-value="1"
                                inactive-value="0">
                            </el-switch>
                        </el-tooltip>
                    </el-form-item>
                </el-form>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="editBrandForm = false">Cancel</el-button>
                    <el-button type="primary" @click="editItem(editForm.id)">Confirm</el-button>
                </span>
                </el-dialog>
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Nhãn hiệu</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Nhãn hiệu</li>
                            </ol>
                            <el-button type="button" class="btn btn-info d-none d-lg-block m-l-15" @click="addBrandForm = true"><i class="fa fa-plus-circle"></i> Create New</el-button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <el-table
                        :data="brands.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
                        :default-sort = "{prop: 'id', order: 'ascending'}"
                        border
                        style="width: 100%">
                            <el-table-column
                            fixed
                            prop="id"
                            label="ID"
                            sortable
                            resizable	
                            width="100">
                            </el-table-column>
                            <el-table-column
                            prop="image"
                            label="Image"
                            sortable
                            resizable
                            style="width:100px"
                            >
                            <template slot-scope="scope">
                                <img :src="scope.row.image" style="width:100%"/>
                            </template>
                            </el-table-column>
                            <el-table-column
                            prop="name"
                            label="Name"
                            sortable
                            resizable	
                            width="300">
                            </el-table-column>
                            <el-table-column
                            prop="status"
                            label="Status"
                            sortable
                            resizable	
                            width="500">
                            <template slot-scope="scope">
                                <span v-if="scope.row.status==1">
                                    Hiện
                                </span>
                                <span v-else>
                                    Ẩn
                                </span>
                            </template>
                            </el-table-column>
                            <el-table-column
                            align="right">
                            <template slot="header" slot-scope="scope">
                                <el-input
                                v-model="search"
                                size="mini"
                                placeholder="Type to search"/>
                            </template>
                            <template slot-scope="scope">
                                <el-button  @click="deleteItem(scope.row.id)" type="text" size="small">Delete</el-button>
                                <el-button @click="formEdit(scope.row)" type="text" size="small">Edit</el-button>
                            </template>
                            </el-table-column>
                        </el-table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </div>
    </span>
</template>

<script>

import sideBar from '../sidebar.vue'
import headTop from '../header.vue'

export default {
    components:{
        sideBar,
        headTop,
    },
    data:function(){
        return{
            brands:[],
            addBrandForm: false,
            search:'',
            form: {
                name: '',
                image:'',
                status: true
                // fileList:[],
            },
            editForm: {
                name: '',
                image:'',
                status: true,
                id: 0,
                // fileList:[],
            },
            editBrandForm: false,
            formLabelWidth: '120px',
            dialogImageUrl: '',
            dialogVisible: false,
            disabled: false,
        }
    },
    methods: {
        getList(){
            axios.get('http://localhost:8000/api/backend/brands')
            .then(response=>{
                this.brands = response.data;
            })
            .catch(error => {
                console.log(error);
            });
            this.form.name = '';
            this.form.image = '';
        },
        addItem(){
            //   console.log(this.$refs.image._data.uploadFiles[0].name);
            //   console.log(this.$refs.image._data.uploadFiles[0].response);
            if(this.form.name == '' || this.form.image==''){
                this.$notify({
                title: 'Lưu ý',
                message: 'Không được bỏ trống',
                type: 'warning'
                });
                return;
            }
            axios.post('http://localhost:8000/api/backend/brand/store',{
                // item: this.$refs.image._data.uploadFiles[0],
                item: this.form,
            })
            .then(response=>{
                if(response.status == 201){
                    // this.item.name = "";
                    // this.$emit('reloadlist');
                    this.addBrandForm = false;
                    this.$notify({
                    title: 'Thành công',
                    message: 'Thêm mới thành công',
                    type: 'success'
                    });
                    this.getList();
                }
            })
            .catch(error=>{
                console.log(error);
                this.$message.error(error);
            })
        },
        formEdit(data){
            // console.log(data);
            this.editForm.name = data.name;
            this.editForm.id = data.id;
            this.editForm.image = data.image;
            this.editForm.status = (data.status) ? true : false;
            this.editBrandForm = true;
        },
        editItem(id){
            if(this.editForm.name == ''){
                this.$message.error('Tên không được bỏ trống');
                return;
            }
            axios.put('http://localhost:8000/api/backend/brand/'+id,{
                item: this.editForm
            })
            .then(response=>{
                if(response.status == 200){
                    this.editBrandForm = false;
                    this.$notify({
                    title: 'Thành công',
                    message: 'Chỉnh sửa thành công',
                    type: 'success'
                    });
                    this.getList();
                    
                }
            })
            .catch(error=>{
                console.log(error);
                this.$message.error(error);
            })
        },
        deleteItem(id){
            axios.delete('http://localhost:8000/api/backend/brand/'+id)
            .then(response=>{
                if(response.status == 200){
                    this.$notify({
                    title: 'Thành công',
                    message: 'Xóa thành công',
                    type: 'success'
                    });
                    this.getList();
                }
            })
            .catch(error=>{
                console.log(error);
            })
        },
    },
    async created(){
        await this.getList();
    }   
}
</script>

