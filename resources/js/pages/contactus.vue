<template>
   <div>
      name: {{ name }} <br>
      email: {{ email }} <br>
      message: {{ message }} <br>
      dummy: {{ dummy }} <br>
      errors: {{ errors }}

      <v-sheet class="mt-6 pt-6 pb-2 px-8">
         <v-row class="mb-4">
            <v-col>
               <v-row>
                  <div class="mx-auto">
                     <v-card flat>
                        <v-card-title
                           class="
                              text-h5
                              font-weight-bold
                              grey--text
                              text--darken-2
                           "
                        >
                           <v-icon large left color="grey darken-1"
                              >mdi-phone
                           </v-icon>
                           Contact Us
                        </v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mx-16 mb-3">
                     <v-form ref="contact_us_form" lazy-validation>
                        <v-text-field
                           v-model="name"
                           :rules="nameRules"
                           label="Name"
                           required
                           outlined
                        ></v-text-field>

                        <v-text-field
                           v-model="email"
                           :rules="emailRules"
                           label="E-mail"
                           type="email"
                           required
                           outlined
                        ></v-text-field>

                        <v-textarea
                           v-model="message"
                           :rules="messageRules"
                           label="Message"
                           auto-grow
                           placeholder="Enter Text Here"
                           rows="1"
                           outlined
                        ></v-textarea>
                        <!-- Validate and Submit -->
                        <v-row class="mt-2">
                           <div class="mx-auto">
                              <v-btn
                                 color="success"
                                 class="mx-2"
                                 @click.prevent="submitForm"
                              >
                                 Submit
                              </v-btn>
                              <!-- Reset From -->
                              <v-btn color="error" class="mx-2" @click="reset">
                                 Reset Form
                              </v-btn>
                              <!-- Reset validation -->
                              <v-btn color="warning" class="mx-2" @click="resetValidation">
                                 Reset Validation
                              </v-btn>
                           </div>
                        </v-row>
                     </v-form>
                  </v-col>
               </v-row>
               <v-row>
                  <!-- Address For Md and Up -->
                  <v-col cols="12" sm="6" md="4" lg="4" class="hidden-xs-only">
                     <v-card flat class="mx-auto" width="300">
                        <v-card-title
                           class="
                              text-body-h6
                              font-weight-bold
                              grey--text
                              text--darken-2
                           "
                        >
                           Gulshan Campus
                        </v-card-title>
                        <v-card-text
                           class="
                              text-body-1
                              font-weight-bold
                              grey--text
                              text--darken-2
                           "
                        >
                           Plot # CEN-16, Road # 106 <br />
                           Gulshan 2, Dhaka-1212 <br />
                           Bangladesh <br />
                           Phone: +88-02-55060025, <br />
                           9862251, 58817525 <br />
                           Mobile: 01780364414 <br />
                           Fax: +88-02-55059924 <br />
                        </v-card-text>
                     </v-card>
                  </v-col>
                  <!-- Address For Sm and Down -->
                  <v-col
                     cols="12"
                     sm="6"
                     md="4"
                     lg="4"
                     class="hidden-sm-and-up"
                  >
                     <v-card flat width="300">
                        <v-card-title
                           class="
                              text-body-h6
                              font-weight-bold
                              grey--text
                              text--darken-2
                           "
                        >
                           Gulshan Campus
                        </v-card-title>
                        <v-card-text
                           class="
                              text-body-1
                              font-weight-bold
                              grey--text
                              text--darken-2
                           "
                        >
                           Plot # CEN-16, Road # 106 <br />
                           Gulshan 2, Dhaka-1212 <br />
                           Bangladesh <br />
                           Phone: +88-02-55060025, <br />
                           9862251, 58817525 <br />
                           Mobile: 01780364414 <br />
                           Fax: +88-02-55059924 <br />
                        </v-card-text>
                     </v-card>
                  </v-col>
                  <!-- Map Component -->
                  <v-col cols="12" sm="6" md="8" lg="8" class="mt-4">
                     <div
                        class="
                           text-body-1
                           font-weight-bold
                           grey--text
                           text--darken-2
                        "
                     >
                        Gulshan Campus Location
                     </div>
                     <div class="pt-3">
                        <iframe
                           src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14603.046330302512!2d90.4146433!3d23.7915029!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x121a03a4382f1df4!2sManarat+International+University!5e0!3m2!1sen!2sbd!4v1545627074631"
                           width="100%"
                           height="400"
                           style="border: 0"
                           allowfullscreen=""
                           loading="eager"
                        ></iframe>
                     </div>
                  </v-col>
               </v-row>
               <v-row>
                  <!-- Address For Md and Up -->
                  <v-col cols="12" sm="6" md="4" lg="4" class="hidden-xs-only">
                     <v-card flat class="mx-auto" width="300">
                        <v-card-title
                           class="
                              text-body-h6
                              font-weight-bold
                              grey--text
                              text--darken-2
                           "
                        >
                           Ashulia Permanent <br />
                           Campus
                        </v-card-title>
                        <v-card-text
                           class="
                              text-body-1
                              font-weight-bold
                              grey--text
                              text--darken-2
                           "
                        >
                           Ashulia Model Town, <br />
                           Khagan, Ashulia <br />
                           Dhaka <br />
                           Phone: 09666911624, <br />
                           09666911625, 09666911626, <br />
                           09666911627 <br />
                           Mobile: 01819245895, <br />
                           01780364415
                        </v-card-text>
                     </v-card>
                  </v-col>
                  <!-- Address For Sm and Down -->
                  <v-col
                     cols="12"
                     sm="6"
                     md="4"
                     lg="4"
                     class="hidden-sm-and-up"
                  >
                     <v-card flat width="300">
                        <v-card-title
                           class="
                              text-body-h6
                              font-weight-bold
                              grey--text
                              text--darken-2
                           "
                        >
                           Ashulia Permanent <br />
                           Campus
                        </v-card-title>
                        <v-card-text
                           class="
                              text-body-1
                              font-weight-bold
                              grey--text
                              text--darken-2
                           "
                        >
                           Ashulia Model Town, <br />
                           Khagan, Ashulia <br />
                           Dhaka <br />
                           Phone: 09666911624, <br />
                           09666911625, 09666911626, <br />
                           09666911627 <br />
                           Mobile: 01819245895, <br />
                           01780364415
                        </v-card-text>
                     </v-card>
                  </v-col>
                  <!-- Map Component -->
                  <v-col cols="12" sm="6" md="8" lg="8" class="mt-4">
                     <div
                        class="
                           text-body-1
                           font-weight-bold
                           grey--text
                           text--darken-2
                        "
                     >
                        Ashulia Permanent Campus Location
                     </div>
                     <div class="pt-3">
                        <iframe
                           src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29186.769300654392!2d90.30785646504465!3d23.87734075018992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c213b785c80f%3A0x160471c997db5233!2sManarat%20International%20University!5e0!3m2!1sen!2sbd!4v1626133954937!5m2!1sen!2sbd"
                           width="100%"
                           height="400"
                           style="border: 0"
                           allowfullscreen=""
                           loading="eager"
                        ></iframe>
                     </div>
                  </v-col>
               </v-row>
            </v-col>
         </v-row>
      </v-sheet>
   </div>
</template>

<script>
export default {
   data: () => ({
      dummy:"",
      errors:[],
      name: "",
      nameRules: [(v) => !!v || "Name is required"],
      email: "",
      emailRules: [
         (v) => !!v || "E-mail is required",
         (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      message: "",
      messageRules: [(v) => !!v || "A message is required"],
   }),

   methods: {
      submitForm() {
         this.validation = this.$refs.contact_us_form.validate();
         if (this.$refs.contact_us_form.validate()) {
            axios.post("/api/", {
                    // name: this.name
                    // email: this.email,
                    // message: this.message
                })
                .then((res) => {
                    console.log(res)
                    this.dummy = "Login Post Request Sent Successfully !!";
                    // console.log(res);
                    this.$router.push({ name: "AdminPanel" });
                })
                .catch((error) => {
                    cosole.log(error)
                    this.errors = error.response.data.errors;
                    this.dummy = "Request Not Sent !!";
                });            
         } else {
            //false
            this.$refs.contact_us_form.validate();
         }
      },
      reset() {
         this.$refs.contact_us_form.reset();
      },
      resetValidation() {
         this.$refs.contact_us_form.resetValidation();
      },
   },
};
</script>

<style></style>
