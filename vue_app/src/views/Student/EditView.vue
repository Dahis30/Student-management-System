<template>
  <div class="container mt-4">
    <div class="card">
      <div class="card-header">
        <h1>EDIT student</h1>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label for="">Name</label>
          <input
            type="text"
            v-model="model.student.name"
            class="form-control"
          />
        </div>
        <div class="mb-3">
          <label for="">Email</label>
          <input
            type="text"
            v-model="model.student.email"
            class="form-control"
          />
        </div>
        <div class="mb-3">
          <label for="">Phone</label>
          <input
            type="text"
            v-model="model.student.phone"
            class="form-control"
          />
        </div>
        <div class="mb-3">
          <label for="">COURSE</label>
          <input
            type="text"
            v-model="model.student.course"
            class="form-control"
          />
        </div>
        <div class="mt-2">
          <ul v-if="Object.keys(this.error_list)">
            <li
              style="color: red"
              v-for="(error, index) in error_list"
              :key="index"
            >
              {{ error[0] }}
            </li>
          </ul>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" @click="Save_Students">UPDATE</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "EditView",
  data() {
    return {
      error_list: "",
      model: {
        student: {
          name: "",
          email: "",
          phone: "",
          course: "",
        },
      },
    };
  },
  mounted() {
    this.getStudent();
  },
  methods: {
    getStudent() {
      axios
        .get(`http://127.0.0.1:8000/api/student/${this.$route.params.id}/edit`)
        .then((res) => {
          this.model.student = res.data.student;
        })
        .catch(function (error) {
          if (error.response) {
            if (error.response.status == 404) {
              alert(error.response.data.message);
            }
          } else if (error.request) {
            console.log(error.request);
          } else {
            console.log("Error", error.message);
          }
          console.log(error.config);
        });
    },
    Save_Students() {
      var mythis = this;
      axios
        .put(
          `http://127.0.0.1:8000/api/student/${this.$route.params.id}/edit`,
          this.model.student
        )
        .then((res) => {
          console.log(res.data);
          alert(res.data.message);
          this.error_list = "";
        })
        .catch(function (error) {
          if (error.response) {
            if (error.response.status == 422) {
              mythis.error_list = error.response.data.errors;
            }
          } else if (error.request) {
            console.log(error.request);
          } else {
            console.log("Error", error.message);
          }
          console.log(error.config);
        });
    },
  },
};
</script>
