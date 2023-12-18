import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import StudentView from "../views/Student/StudentView.vue";
import CreateView from "../views/Student/CreateView.vue";
import EditView from "../views/Student/EditView.vue";
import StudentOnly from "../views/Student/StudentOnly.vue"
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/StudentView",
      name: "StudentView",
      component: StudentView,
    },
    {
      path: "/create",
      name: "CreateView",
      component: CreateView,
    },
    {
      path: "/Student/:id/edit",
      name: "EditView",
      component: EditView,
    },
    {
      path: "/Student/:id",
      name: "StudentOnly",
      component: StudentOnly,
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AboutView.vue"),
    },
  ],
});

export default router;
