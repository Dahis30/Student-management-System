<template>
  <div>
    <div class="container">
      <div class="card mt-5">
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
                  <RouterLink :to="{path : '/Student/'+student.id+'/edit'}" class="btn btn-success">EDIT</RouterLink>
                </td>
                <td>
                  <RouterLink to="/" class="btn btn-danger">DELETE</RouterLink>
                </td>
              </tr>
            </tbody>
            <tbody v-else>
              <tr>
                <td colspan="7">LOADING ...</td>
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
    };
  },
  mounted() {
    this.getStudents();
    // console.log("im here")
  },
  methods: {
    getStudents() {
      axios.get("http://127.0.0.1:8000/api/student").then((res) => {
        this.students = res.data.students;
      });
    },
  },
  components: { RouterLink },
};
</script>
