<template>
    <span>
        <side-bar/>
        <head-top/>
        <div class="page-wrapper">
            <div class="container-fluid">
                <el-dialog title="Thêm nhãn hiệu" :visible.sync="addColorForm">
                <el-form :model="form">
                    <el-form-item label="Tên màu" :label-width="formLabelWidth">
                        <el-input v-model="form.name" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Mã màu" :label-width="formLabelWidth">
                        <el-color-picker v-model="form.color_code"></el-color-picker>
                    </el-form-item>
                </el-form>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="addColorForm = false">Cancel</el-button>
                    <el-button type="primary" @click="addItem()">Confirm</el-button>
                </span>
                </el-dialog>
                <el-dialog title="Thêm nhãn hiệu" :visible.sync="editColorForm">
                <el-form :model="editForm">
                    <el-form-item label="Tên màu" :label-width="formLabelWidth">
                        <el-input v-model="editForm.name" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Mã màu" :label-width="formLabelWidth">
                        <el-color-picker v-model="editForm.color_code"></el-color-picker>
                    </el-form-item>
                </el-form>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="editColorForm = false">Cancel</el-button>
                    <el-button type="primary" @click="editItem(editForm.id)">Confirm</el-button>
                </span>
                </el-dialog>
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Màu sản phẩm</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Màu sản phẩm</li>
                            </ol>
                            <el-button type="button" class="btn btn-info d-none d-lg-block m-l-15" @click="addColorForm = true"><i class="fa fa-plus-circle"></i> Create New</el-button>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <el-table
                        :data="colors.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
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
                            prop="color_code"
                            label="Màu"
                            sortable
                            resizable
                            style="width:100px"
                            >
                            <template slot-scope="scope">
                                <div :style="'background: '+scope.row.color_code+';width:120px !important;height:100px !important'"></div>
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

import sideBar from '../../sidebar.vue'
import headTop from '../../header.vue'

export default {
    components:{
        sideBar,
        headTop
    },
    data: function(){
        return {
            search: '',
            colors:[],
            addColorForm: false,
            editColorForm: false,
            formLabelWidth: '120px',
            form: {
                name: '',
                color_code:''
                // fileList:[],
            },
            editForm: {
                id: '',
                name: '',
                color_code:''
                // fileList:[],
            },
        }
    },
    methods: {
        getList(){
            axios.get('http://localhost:8000/api/backend/product/colors')
            .then(response=>{
                this.colors = response.data;
            })
            .catch(error => {
                console.log(error);
            });
            this.form.name = '';
            this.form.color_code = '';
        },
        addItem(){
            console.log(this.form);
            if(this.form.name == '' || this.form.color==''){
                this.$notify({
                title: 'Lưu ý',
                message: 'Không được bỏ trống',
                type: 'warning'
                });
                return;
            }
            axios.post('http://localhost:8000/api/backend/product/color/store',{
                item: this.form,
            })
            .then(response=>{
                if(response.status == 201){
                    this.addColorForm = false;
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
            this.editForm.id = data.id;
            this.editForm.name = data.name;
            this.editForm.color_code = data.color_code;
            this.editColorForm = true;
        },
        editItem(id){
            if(this.editForm.name == ''){
                this.$message.error('Tên không được bỏ trống');
                return;
            }
            axios.put('http://localhost:8000/api/backend/product/color/'+id,{
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
                    this.editColorForm = false;
                    
                }
            })
            .catch(error=>{
                console.log(error);
                this.$message.error(error);
            })
        },
        deleteItem(id){
            axios.delete('http://localhost:8000/api/backend/product/color/'+id)
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
        }
    },
    async created(){
        await this.getList();
    }
}
</script>