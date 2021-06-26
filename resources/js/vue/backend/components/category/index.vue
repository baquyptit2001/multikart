<template>
    <span>
        <top-head/>
        <side-bar/>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <el-dialog title="Thêm danh mục" :visible.sync="addCateForm">
                    <el-form :model="form">
                        <el-form-item label="Tên danh mục" :label-width="formLabelWidth">
                        <el-input v-model="form.name" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Danh mục cha" :label-width="formLabelWidth">
                            <el-select v-model="form.parent_id" placeholder="Chọn danh mục cha">
                                <el-option  label="Danh mục cha" value="0"></el-option>
                                <el-option  v-for="item in categories" :key="item.id" :label="item.name" :value="item.id"></el-option>
                            </el-select>
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
                        <el-button @click="addCateForm = false">Hủy</el-button>
                        <el-button type="primary" @click="addItem()">Thêm mới</el-button>
                    </span>
                </el-dialog>
                <el-dialog title="Chỉnh sửa danh mục" :visible.sync="editCateForm">
                    <el-form :model="editForm">
                        <el-form-item label="Tên danh mục" :label-width="formLabelWidth">
                        <el-input v-model="editForm.name" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Danh mục cha" :label-width="formLabelWidth">
                            <el-select v-model="editForm.parent_id" placeholder="Chọn danh mục cha">
                                <el-option  label="Danh mục cha" value="0" selected></el-option>
                                <el-option  v-for="item in categories" :key="item.id" :label="item.name" :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <!-- <el-form-item label="Trạng thái" :label-width="formLabelWidth">
                            <el-tooltip :content="editForm.status" placement="top">
                                <el-switch
                                    v-model="editForm.status"
                                    active-value="1"
                                    inactive-value="0">
                                </el-switch>
                            </el-tooltip>
                        </el-form-item> -->
                        <el-form-item label="Trạng thái">
                            <el-switch v-model="editForm.status"></el-switch>
                        </el-form-item>
                    </el-form>
                    <span slot="footer" class="dialog-footer">
                        <el-button @click="editCateForm = false">Hủy</el-button>
                        <el-button type="primary" @click="editItem(editForm.id)">Cập nhật</el-button>
                    </span>
                </el-dialog>
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Danh mục</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Danh mục</li>
                            </ol>
                            <el-button type="button" class="btn btn-info d-none d-lg-block m-l-15" @click="addCateForm = true"><i class="fa fa-plus-circle"></i> Create New</el-button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <el-table
                        :data="categories.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
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
                            prop="name"
                            label="Name"
                            sortable
                            resizable	
                            width="300">
                            </el-table-column>
                            <el-table-column
                            prop="parent.name"
                            label="Parent"
                            sortable
                            resizable	
                            width="300">
                                <template slot-scope="scope">
                                    <span v-if="scope.row.parent == null">
                                        Danh mục cha
                                    </span>
                                    <span v-else>
                                        {{ scope.row.parent.name }}
                                    </span>
                                </template>
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
            </div>
        </div>
    </span>
</template>

<script>

import topHead from '../header.vue'
import sideBar from '../sidebar.vue'

export default {
    data: function(){
        return {
            categories: [],
            search: '',
            addCateForm: false,
            form: {
                name: '',
                parent_id: '0',
                status:true,
            },
            editCateForm: false,
            editForm: {
                name: 'abc',
                parent_id: '0',
                status:true,
                id:''
            },
            user:[],
            formLabelWidth: '120px',
        }
    },
    components:{
        topHead,
        sideBar,
    },
    methods:{
        getList(){
            axios.get('http://localhost:8000/api/backend/categories')
            .then(response=>{
                this.categories = response.data;
            })
            .catch(error => {
                console.log(error);
            })
        },
        addItem(){
            if(this.form.name == ''){
                this.$message.error('Tên không được bỏ trống');
                return;
            }
            axios.post('http://localhost:8000/api/backend/category/store',{
                item: this.form
            })
            .then(response=>{
                if(response.status == 201){
                    // this.item.name = "";
                    // this.$emit('reloadlist');
                    this.addCateForm = false;
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
        deleteItem(id){
            axios.delete('http://localhost:8000/api/backend/category/'+id)
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
        editItem(id){
            if(this.editForm.name == ''){
                this.$notify({
                title: 'Lưu ý',
                message: 'Không được bỏ trống',
                type: 'warning'
                });
                return;
            }
            axios.put('http://localhost:8000/api/backend/category/'+id,{
                item: this.editForm
            })
            .then(response=>{
                if(response.status == 200){
                    this.editCateForm = false;
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
        formEdit(data){
            this.editForm.name = data.name;
            this.editForm.parent_id = data.parent_id;
            this.editForm.status = (data.status) ? true : false;
            this.editForm.id = data.id;
            this.editCateForm = true;
            console.log(this.editForm);
        }
    },
    async created(){
        await this.getList();
    }
}
</script>