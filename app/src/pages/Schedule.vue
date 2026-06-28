<template>
  <div>

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-xl font-bold text-gray-900">
          Tour Schedules
        </h1>

        <p class="text-sm text-gray-500 mt-0.5">
          {{ rows.length }} total jadwal
        </p>
      </div>


      <button
        @click="openAdd"
        class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-green-600 text-white text-sm font-semibold hover:bg-green-700 transition-colors"
      >
        <Plus class="w-4 h-4" />
        Tambah
      </button>
    </div>



    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

      <div class="p-4 border-b border-gray-50">

        <div class="relative max-w-xs">

          <Search
            class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
          />


          <input
            v-model="query"
            placeholder="Cari jadwal..."
            class="pl-9 pr-4 py-2 rounded-xl border border-gray-200 text-sm w-full focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500"
          />

        </div>

      </div>



      <div class="overflow-x-auto">

        <table class="w-full text-sm">

          <thead>

            <tr class="bg-gray-50 border-b border-gray-100">

              <th class="px-4 py-3 text-left">#</th>

              <th class="px-4 py-3 text-left">
                Paket Tur
              </th>

              <th class="px-4 py-3 text-left hidden sm:table-cell">
                Mulai
              </th>

              <th class="px-4 py-3 text-left hidden sm:table-cell">
                Selesai
              </th>

              <th class="px-4 py-3 text-left hidden md:table-cell">
                Kuota
              </th>

              <th class="px-4 py-3 text-left hidden lg:table-cell">
                Status
              </th>

              <th></th>

            </tr>

          </thead>



          <tbody class="divide-y divide-gray-50">


            <tr v-if="filtered.length === 0">

              <td
                colspan="7"
                class="text-center py-12 text-gray-400"
              >
                Tidak ada data
              </td>

            </tr>



            <tr
              v-for="r in filtered"
              :key="r.id"
              class="hover:bg-gray-50/50"
            >

              <td class="px-4 py-3 text-gray-400">
                {{ r.id }}
              </td>


              <td class="px-4 py-3 font-medium text-gray-900 max-w-[200px] truncate">

                {{ pkgTitle(r.tour_package_id) }}

              </td>



              <td class="px-4 py-3 hidden sm:table-cell">
                {{ r.start_date }}
              </td>


              <td class="px-4 py-3 hidden sm:table-cell">
                {{ r.end_date }}
              </td>


              <td class="px-4 py-3 hidden md:table-cell font-medium">
                {{ r.quota }} pax
              </td>



              <td class="px-4 py-3 hidden lg:table-cell">

                <span
                  :class="[
                    'px-2.5 py-0.5 rounded-full text-xs font-medium',
                    scheduleStatus(r).cls
                  ]"
                >
                  {{ scheduleStatus(r).label }}
                </span>

              </td>



              <td class="px-4 py-3">

                <div class="flex justify-end gap-1">

                  <button
                    @click="openEdit(r)"
                    class="p-1.5 rounded-lg hover:bg-blue-50 text-gray-400 hover:text-blue-600"
                  >

                    <Pencil class="w-3.5 h-3.5"/>

                  </button>



                  <button
                    @click="openDelete(r)"
                    class="p-1.5 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600"
                  >

                    <Trash2 class="w-3.5 h-3.5"/>

                  </button>

                </div>

              </td>

            </tr>


          </tbody>

        </table>

      </div>

    </div>




    <!-- Modal -->

    <Modal
      v-if="modal === 'add' || modal === 'edit'"
      :title="modal === 'add' ? 'Tambah Jadwal' : 'Edit Jadwal'"
      @close="modal = null"
    >


      <div class="flex flex-col gap-4">


        <Field label="Paket Tur">


          <div class="relative">

            <select
              v-model.number="form.tour_package_id"
              :class="inputCls + ' appearance-none pr-8'"
            >

              <optgroup
                v-for="group in pkgsByDest"
                :key="group.dest.id"
                :label="group.dest.name"
              >

                <option
                  v-for="pkg in group.pkgs"
                  :key="pkg.id"
                  :value="pkg.id"
                >

                  {{ pkg.title }}

                </option>

              </optgroup>


            </select>



            <ChevronDown
              class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
            />


          </div>


        </Field>




        <div class="grid grid-cols-2 gap-3">


          <Field label="Tanggal Mulai">

            <input
              type="date"
              v-model="form.start_date"
              :class="inputCls"
            />

          </Field>



          <Field label="Tanggal Selesai">

            <input
              type="date"
              v-model="form.end_date"
              :class="inputCls"
            />

          </Field>


        </div>




        <Field label="Kuota (pax)">

          <input
            type="number"
            min="1"
            v-model.number="form.quota"
            :class="inputCls"
          />

        </Field>




        <div class="flex gap-3 pt-2">


          <button
            @click="modal=null"
            class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200"
          >
            Batal
          </button>



          <button
            @click="save"
            :disabled="!form.start_date || !form.end_date"
            class="flex-1 px-4 py-2.5 rounded-xl bg-green-600 text-white disabled:opacity-40"
          >
            Simpan
          </button>


        </div>


      </div>


    </Modal>



    <DeleteConfirm
      v-if="modal==='delete' && selected"
      :name="`${pkgTitle(selected.tour_package_id)} (${selected.start_date})`"
      @confirm="del"
      @close="modal=null"
    />


  </div>
</template>



<script setup lang="ts">

import { ref, computed } from "vue";

import {
  Plus,
  Search,
  Pencil,
  Trash2,
  ChevronDown
} from "lucide-vue-next";


import Modal from "@/components/ui/Modal.vue";
import Field from "@/components/ui/Field.vue";
import DeleteConfirm from "@/components/ui/DeleteConfirm.vue";


import {
  inputCls
} from "@/utils/styles";


import {
  seedSchedules
} from "@/data/schedules";


import {
  seedPackages
} from "@/data/packages";


import {
  seedDestinations
} from "@/data/destinations";


import type {
  TourSchedule
} from "@/types/tourcschedule";



type ScheduleForm = Omit<TourSchedule,"id">;



const blank:ScheduleForm = {

  tour_package_id:0,

  start_date:"",

  end_date:"",

  quota:1

};



const rows = ref<TourSchedule[]>([
  ...seedSchedules
]);


const query = ref("");


const modal =
  ref<"add"|"edit"|"delete"|null>(null);



const selected =
  ref<TourSchedule|null>(null);



const form =
  ref<ScheduleForm>({
    ...blank
  });




const filtered = computed(()=>{

  const q=query.value.toLowerCase();


  return rows.value.filter(r=>

    pkgTitle(r.tour_package_id)
      .toLowerCase()
      .includes(q)

  );

});




const pkgsByDest = computed(()=>{


  return seedDestinations.map(dest=>({


    dest,


    pkgs: seedPackages.filter(
      p=>p.destination_id===dest.id
    )


  })).filter(
    x=>x.pkgs.length
  );


});





function pkgTitle(id:number){

  return seedPackages.find(
    p=>p.id===id
  )?.title ?? "-";

}





function scheduleStatus(schedule:TourSchedule){


  const today =
    new Date()
      .toISOString()
      .slice(0,10);



  if(schedule.start_date < today){

    return {
      label:"Selesai",
      cls:"bg-gray-100 text-gray-600"
    };

  }



  return {

    label:"Mendatang",

    cls:"bg-green-50 text-green-700"

  };


}





function openAdd(){

  form.value={
    ...blank
  };

  modal.value="add";

}





function openEdit(row:TourSchedule){

  selected.value=row;

  form.value={
    ...row
  };


  modal.value="edit";

}





function openDelete(row:TourSchedule){

  selected.value=row;

  modal.value="delete";

}





function save(){


  if(modal.value==="add"){

    rows.value.push({

      ...form.value,

      id:Date.now()

    });


  }



  if(modal.value==="edit" && selected.value){


    rows.value =
      rows.value.map(r=>

        r.id===selected.value!.id

        ? {
          ...form.value,
          id:r.id
        }

        : r

      );

  }



  modal.value=null;


}




function del(){


  if(selected.value){


    rows.value =
      rows.value.filter(
        r=>r.id!==selected.value!.id
      );


  }


  modal.value=null;


}



</script>