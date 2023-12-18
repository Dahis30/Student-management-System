<template>
  <div>
    <div class="container">
      <div class="mt-3" style="text-align: center">
        <button class="btn btn-success" v-if="delete_msg.length > 0">
          {{ delete_msg }}
        </button>
      </div>
      <div class="card mt-2">
        <div class="card-hearder mt-3 mx-2">
          <h4>
            Students
            <RouterLink class="btn btn-primary float-end" to="/create">
              Add Student
            </RouterLink>
          </h4>
        </div>
        <div class="card-body">
          <table class="table table-bordred">
            <thead>
              <th>ID</th>
              <th>NAME</th>
              <th>EMAIL</th>
              <th>PHONE</th>
              <th>COURSE</th>
              <th>EDIT</th>
              <th>DELETE</th>
            </thead>
            <tbody v-if="this.students.length > 0">
              <tr v-for="(student, index) in this.students" :key="index">
                <td>{{ student.id }}</td>
                <td>{{ student.name }}</td>
                <td>{{ student.email }}</td>
                <td>{{ student.phone }}</td>
                <td>{{ student.course }}</td>
                <td>
                  <RouterLink
                    :to="{ path: '/Student/' + student.id + '/edit' }"
                    class="btn btn-success"
                    >EDIT</RouterLink
                  >
                </td>
                <td>
                  <button
                    @click="deletStudent(student.id)"
                    class="btn btn-danger"
                  >
                    DELETE
                  </button>
                </td>
                <!-- <td>
                  <RouterLink :to="{path :'/Student/'+student.id+'/delete'}" class="btn btn-danger">DELETE</RouterLink>
                </td> -->
              </tr>
            </tbody>
            <tbody v-else>
              <tr>
                <td colspan="7">{{ no_student_msg }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { RouterLink } from "vue-router";
export default {
  name: "StudentView",
  data() {
    return {
      students: [],
      delete_msg: "",
      no_student_msg: "Loading",
    };
  },
  mounted() {
    this.getStudents();
    // console.log("im here")
  },
  methods: {
    getStudents() {
      var mythis = this;
      axios
        .get("http://127.0.0.1:8000/api/student")
        .then((res) => {
          this.students = res.data.students;
        })
        .catch(function (error) {
          if (error.response) {
            if (error.response.data.status == 404) {
              mythis.no_student_msg = error.response.data.message;
            }
          } else if (error.request) {
            console.log(error.request);
          } else {
            console.log("Error", error.message);
          }
          console.log(error.config);
        });
    },
    deletStudent(id) {
      axios
        .delete(`http://127.0.0.1:8000/api/student/${id}/delete`)
        .then((res) => {
          this.delete_msg = "student number " + id + " was deleted";
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
  },
  components: { RouterLink },
};
</script>
