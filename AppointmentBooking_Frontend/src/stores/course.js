import { defineStore } from "pinia";

export const useCourseStore = defineStore("courseStore", {
  state: () => {
    return {
      courses: [],
      errors: {},
    };
  },
  actions: {
    /******************* Get all courses *******************/
    async getCourses() {
      const res = await fetch("/api/courses", {
        headers: {
          authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await res.json();
      if (res.ok) {
        this.courses = data;
      } else {
        this.errors = data.errors || { general: "Hiba történt a kurzusok betöltésekor." };
      }
    },

    /******************* Create a new course *******************/
    async createCourse(courseData) {
      const res = await fetch("/api/courses", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          authorization: `Bearer ${localStorage.getItem("token")}`,
        },
        body: JSON.stringify(courseData),
      });

      const data = await res.json();
      if (res.ok) {
        this.courses.push(data.course); 
        return { success: true, message: "Kurzus sikeresen létrehozva!" };
      } else {
        this.errors = data.errors || { general: "Hiba történt a kurzus létrehozása közben." };
        return { success: false, message: "Hiba történt a kurzus létrehozása közben." };
      }
    },

    /******************* Update a course *******************/
    async updateCourse(courseId, updatedData) {
      const res = await fetch(`/api/courses/${courseId}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
          authorization: `Bearer ${localStorage.getItem("token")}`,
        },
        body: JSON.stringify(updatedData),
      });

      const data = await res.json();
      if (res.ok) {
        const index = this.courses.findIndex(course => course.id === courseId);
        if (index !== -1) {
          this.courses[index] = data.course;
        }
        return { success: true, message: "Kurzus sikeresen frissítve!" };
      } else {
        this.errors = data.errors || { general: "Hiba történt a kurzus frissítése közben." };
        return { success: false, message: "Hiba történt a kurzus frissítése közben." };
      }
    },

    /******************* Delete a course *******************/
    async deleteCourse(courseId) {
      const res = await fetch(`/api/courses/${courseId}`, {
        method: "DELETE",
        headers: {
          authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });

      if (res.ok) {
        this.courses = this.courses.filter(course => course.id !== courseId);
        return { success: true, message: "Kurzus sikeresen törölve!" };
      } else {
        const data = await res.json();
        this.errors = data.errors || { general: "Hiba történt a kurzus törlésénél." };
        return { success: false, message: "Hiba történt a kurzus törlésénél." };
      }
    },
  },
});
