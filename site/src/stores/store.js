import { defineStore } from "pinia"

export const useSiteStore = defineStore('sitestore', {
  state: () => ({
    isAuthenticated: sessionStorage.getItem('isAuthenticated') ?? false,
    name: sessionStorage.getItem('name') ?? '',
    email: sessionStorage.getItem('email') ?? '',
  }),
  actions: {
    login(userData){
      this.isAuthenticated = true
      this.name = userData.name
      this.email = userData.email
    },
    logout(){
      sessionStorage.clear()
      this.isAuthenticated = false
      this.name = ''
      this.email = ''
    }
  },
})