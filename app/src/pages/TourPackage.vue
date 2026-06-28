<template>
  <div>
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-xl font-bold text-gray-900">
          Tour Packages
        </h1>

        <p class="text-sm text-gray-500 mt-0.5">
          {{ rows.length }} total paket
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
            placeholder="Cari paket..."
            class="pl-9 pr-4 py-2 rounded-xl border border-gray-200 text-sm w-full focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500"
          />
        </div>
      </div>


      <div class="overflow-x-auto">
        <table class="w-full text-sm">

          <thead>
            <tr class="bg-gray-50 border-b border-gray-100">
              <th class="px-4 py-3 text-left">#</th>
              <th class="px-4 py-3 text-left">Judul</th>
              <th class="px-4 py-3 text-left hidden sm:table-cell">
                Destinasi
              </th>
              <th class="px-4 py-3 text-left hidden md:table-cell">
                Tipe
              </th>
              <th class="px-4 py-3 text-left hidden lg:table-cell">
                Harga
              </th>
              <th class="px-4 py-3 text-left hidden lg:table-cell">
                Durasi
              </th>
              <th class="px-4 py-3 text-left hidden xl:table-cell">
                Diskon
              </th>
              <th></th>
            </tr>
          </thead>


          <tbody class="divide-y divide-gray-50">

            <tr v-if="filtered.length === 0">
              <td
                colspan="8"
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
                {{ r.title }}
              </td>


              <td class="px-4 py-3 hidden sm:table-cell">
                {{ destName(r.destination_id) }}
              </td>


              <td class="px-4 py-3 hidden md:table-cell">

                <span
                  :class="[
                    'px-2.5 py-0.5 rounded-full text-xs font-medium',
                    r.type === 'Open Trip'
                      ? 'bg-blue-50 text-blue-700'
                      : 'bg-purple-50 text-purple-700'
                  ]"
                >
                  {{ r.type }}
                </span>

              </td>


              <td class="px-4 py-3 hidden lg:table-cell">

                <div class="font-medium text-gray-900">
                  {{ fmtPrice(r.price) }}
                </div>

                <div
                  v-if="r.is_discount"
                  class="text-xs text-gray-400 line-through"
                >
                  {{ fmtPrice(r.price_original) }}
                </div>

              </td>


              <td class="px-4 py-3 hidden lg:table-cell">
                {{ r.duration_days }}H
              </td>


              <td class="px-4 py-3 hidden xl:table-cell">

                <span
                  v-if="r.is_discount"
                  class="px-2.5 py-0.5 rounded-full text-xs bg-orange-50 text-orange-600"
                >
                  Diskon
                </span>

                <span
                  v-else
                  class="text-gray-300 text-xs"
                >
                  —
                </span>

              </td>


              <td class="px-4 py-3">

                <div class="flex justify-end gap-1">

                  <button
                    @click="openEdit(r)"
                    class="p-1.5 rounded-lg hover:bg-blue-50 text-gray-400 hover:text-blue-600"
                  >
                    <Pencil class="w-3.5 h-3.5" />
                  </button>


                  <button
                    @click="openDelete(r)"
                    class="p-1.5 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600"
                  >
                    <Trash2 class="w-3.5 h-3.5" />
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
      :title="modal === 'add' ? 'Tambah Paket' : 'Edit Paket'"
      @close="modal = null"
    >

      <div class="flex flex-col gap-4">


        <Field label="Destinasi">

          <div class="relative">

            <select
              v-model.number="form.destination_id"
              :class="inputCls + ' appearance-none pr-8'"
            >

              <option
                v-for="d in seedDestinations"
                :key="d.id"
                :value="d.id"
              >
                {{ d.name }}
              </option>

            </select>


            <ChevronDown
              class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
            />

          </div>

        </Field>


        <Field label="Judul Paket">

          <input
            v-model="form.title"
            :class="inputCls"
          />

        </Field>


        <div class="grid grid-cols-2 gap-3">

          <Field label="Tipe">

            <select
              v-model="form.type"
              :class="inputCls"
            >
              <option>
                Open Trip
              </option>

              <option>
                Private Tour
              </option>

            </select>

          </Field>


          <Field label="Durasi (hari)">

            <input
              v-model.number="form.duration_days"
              type="number"
              :class="inputCls"
            />

          </Field>

        </div>


        <div class="grid grid-cols-2 gap-3">

          <Field label="Harga">

            <input
              v-model.number="form.price"
              type="number"
              :class="inputCls"
            />

          </Field>


          <Field label="Harga Asli">

            <input
              v-model.number="form.price_original"
              type="number"
              :class="inputCls"
            />

          </Field>

        </div>


        <Field label="Deskripsi">

          <textarea
            v-model="form.description"
            :class="textareaCls"
            rows="3"
          />

        </Field>


        <label class="flex items-center gap-2.5 cursor-pointer">

          <div
            @click="form.is_discount = !form.is_discount"
            :class="[
              'relative rounded-full transition-colors w-10 h-5.5',
              form.is_discount
                ? 'bg-green-500'
                : 'bg-gray-200'
            ]"
          >

            <div
              :class="[
                'absolute top-0.5 w-4 h-4 bg-white rounded-full transition-all',
                form.is_discount
                  ? 'left-5'
                  : 'left-0.5'
              ]"
            />

          </div>


          <span class="text-sm">
            Aktifkan Diskon
          </span>

        </label>


        <div class="flex gap-3">

          <button
            @click="modal = null"
            class="flex-1 px-4 py-2.5 rounded-xl border"
          >
            Batal
          </button>


          <button
            @click="save"
            :disabled="!form.title"
            class="flex-1 px-4 py-2.5 rounded-xl bg-green-600 text-white disabled:opacity-40"
          >
            Simpan
          </button>

        </div>


      </div>

    </Modal>


    <DeleteConfirm
      v-if="modal === 'delete' && selected"
      :name="selected.title"
      @confirm="del"
      @close="modal = null"
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
  inputCls,
  textareaCls
} from "@/utils/styles";


import { seedPackages } from "@/data/packages";
import { seedDestinations } from "@/data/destinations";


import type { TourPackage } from "@/types/tourpackage";


type PackageForm = Omit<TourPackage, "id">;


const blank: PackageForm = {
  destination_id: 0,
  title: "",
  type: "Open Trip",
  duration_days: 1,
  price: 0,
  price_original: 0,
  description: "",
  is_discount: false
};


const rows = ref<TourPackage[]>([...seedPackages]);

const query = ref("");

const modal =
  ref<"add" | "edit" | "delete" | null>(null);


const selected =
  ref<TourPackage | null>(null);


const form =
  ref<PackageForm>({...blank});


const filtered = computed(() => {

  const q = query.value.toLowerCase();

  return rows.value.filter(r =>
    r.title.toLowerCase().includes(q)
  );

});


function destName(id:number){

  return seedDestinations.find(
    d => d.id === id
  )?.name ?? "-";

}


function fmtPrice(value:number){

  return new Intl.NumberFormat("id-ID", {
    style:"currency",
    currency:"IDR",
    maximumFractionDigits:0
  }).format(value);

}


function openAdd(){

  form.value = {...blank};

  modal.value = "add";

}


function openEdit(row:TourPackage){

  selected.value = row;

  form.value = {
    ...row
  };

  modal.value="edit";

}


function openDelete(row:TourPackage){

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
      rows.value.map(r =>
        r.id===selected.value!.id
        ? {...form.value,id:r.id}
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