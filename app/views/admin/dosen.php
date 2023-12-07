<div class="flex-1 pl-8 pb-8 pt-6 pr-8 shadow-sm main_content">
  <div id="data_dosen">
    <div class="containerBars_toggled">
      <i class="fa-solid fa-bars icon_bars toggle_bars toggle_bars_toggled"></i>
    </div>
    <h1 class="text-2xl font-bold mb-2">Data Dosen</h1>

    <div class="flex bg-white h-10 items-center shadow-sm subtitle_dashboard">
      <div class="flex-1 ml-4">Kelola Data Dosen</div>
    </div>
    <hr class="hr_db">
    <div class="flex bg-white">
      <div class="flex-1 bg-white p-4"> <!-- Tambahkan "flex" class di sini -->
        <!-- <div class="flex-1 notif_db h-10 flex items-center pl-2">Ini adalah data system</div> -->
        <div class="grid grid-cols-1 gap-4">
          <div class="container mx-auto mt-8 containerTableDosen overflow-x-auto">
            <table id="tableDosen" class="min-w-full border ">
              <!-- Tambahkan header tabel di sini -->
              <thead>
                <tr class="border-b">
                  <th class="py-2 px-4 border-r">Nama Dosen</th>
                  <th class="py-2 px-4 border-r">NIP</th>
                  <th class="py-2 px-4 border-r">TTL</th>
                  <th class="py-2 px-4 border-r">Jen. Kelamin</th>
                  <th class="py-2 px-4 border-r">No. Telp</th>
                  <th class="py-2 px-4 border-r">Alamat</th>
                  <th class="py-2 px-4 border-r">Aksi</th>
                  <!-- Tambahkan header lainnya sesuai kebutuhan -->
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['dosen'] as $row) { ?>
                  <!-- Tambahkan baris-baris data di sini -->
                  <tr class="border-b">
                    <td class="py-2 px-4 border-r">
                      <div class="flex items-center">
                        <?php
                        echo '<img src="' . BASEURL . '/img/profil/' . $row['dosen_img'] . '" alt="" class="foto_profil_dosen_table inline ">';
                        // if ($row['jenis_kelamin'] == 'L') {
                        //   echo '<img src="' . BASEURL . '/img/profil/rizky_arifiansyah.jpeg" alt="" class="foto_profil_dosen_table inline ">';
                        // } else {
                        //   echo '<img src="' . BASEURL . '/img/profil/profil.png" alt="" class="foto_profil_dosen_table inline ">';
                        // }
                        ?>
                        <!-- <img src="<?= BASEURL; ?>/img/profil/profil.png" alt="" class="foto_profil_dosen_table inline "> -->
                        <p class="nama_dosen_table inline"><?= $row['nama']; ?></p>
                      </div>
                    </td>
                    <td class="py-2 px-4 border-r"><?= $row['nip']; ?></td>
                    <td class="py-2 px-4 border-r"><?= $row['TTL']; ?></td>
                    <td class="py-2 px-4 border-r">
                      <?php
                      if ($row['jenis_kelamin'] == 'L') {
                        echo '<div class="w-[120px] h-[30px] rounded-full px-1 text-lg font-medium text-blue-800 text-center" style="background-color: #92a9f9;">Laki-Laki</div>';
                      } else {
                        echo '<div class="w-[120px] h-[30px] rounded-full px-1 text-lg font-medium text-rose-600 text-center" style="background-color: #FFB5B5;">Perempuan</div>';
                      }
                      ?>
                    </td>
                    <td class="py-2 px-4 border-r"><?= $row['no_phone']; ?></td>
                    <td class="py-2 px-4 border-r"><?= $row['alamat']; ?></td>
                    <td class="py-2 px-4 border-r">
                      <div class="inline-flex">
                        <a href="#" onclick="showModal();" class="bg-yellow-500 hover:bg-yellow-700 sm:right-[-100px] text-white font-bold py-2 px-4 rounded mr-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="<?= BASEURL; ?>/Admin/hapusDosen/<?= $row['nip']; ?>" class="bg-red-500 hover:bg-red-700 sm:right-[-100px] text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-trash"></i></a>
                      </div>
                    </td>
                    <!-- Tambahkan data lainnya sesuai kebutuhan -->
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- Tambahkan elemen sesuai kebutuhan Anda -->
        </div>

      </div>

      <!-- Tambahkan elemen sesuai kebutuhan Anda -->
    </div>
  </div>
</div>

<? //php include 'modalTambahEdit.php' 
?>
<div id="static-modal" class="fixed inset-0 hidden overflow-y-auto overflow-x-hidden z-50">
  <!-- Backdrop -->
  <div class="fixed inset-0 bg-black opacity-50 ">

  </div>

  <div class="flex items-center justify-center min-h-screen p-4">
    <div class="bg-white w-full max-w-3xl p-8 rounded-lg shadow-md relative">
      <!-- Tombol untuk menutup modal -->
      <button id="tutupModal" class="absolute top-4 right-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        <i class="fa-solid fa-times"></i>
      </button>

      <!-- Konten Modal -->
      <!-- <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1> -->
      <h3 class="text-2xl mb-7 font-bold">Tambah Data Dosen</h3>
      <form class="mb-3" id="formTambahDosen" action="<?= BASEURL; ?>/Admin/tambahDosen" method="POST" enctype="multipart/form-data">
        <div class="flex flex-col md:flex-row">
          <div class="containerGroupImg md:w-2/6" id="dropAreaImgDosen">
            <img src="<?= BASEURL; ?>/img/icon/Group.png" alt="" style="padding: 50px;" id="noImgDosen">
            <input type="file" id="imgInputDosen" name="imgDosen" style="display:none">
            <div id="preview"></div>
          </div>
          <div class="containerFormModal md:w-4/6 ml-3">
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="nama" id="namaLabel" class="block text-sm font-medium text-gray-900">Nama</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 titikDuaNama">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="nama" id="nama" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_nama hidden">
                      <p class="text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> Nama tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="nip" id="nipLabel" class="block text-sm font-medium text-gray-900">NIP</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 flex titikDuaNip">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="nip" id="nip" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_nip hidden">
                      <p class="mt-2 text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> Nip tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="ttl" id="ttlLabel" class="block text-sm font-medium text-gray-900">TTL</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 flex titikDuaTtl">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="ttl" id="ttl" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_ttl hidden">
                      <p class="mt-2 text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf, </span> Ttl tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="jenkel" id="jenkelLabel" class="block text-sm font-medium text-gray-900">Jenis Kelamin
                </div>
                <div class="w-3/4 inline-flex titikDua">
                  <div class="mr-2">: </div>
                  <select name="jenkel" id="jenisPelanggaran" class="mt-1 p-2 w-full border rounded-md">
                    <option name="jenkel" value="L">Laki-laki</option>
                    <option name="jenkel" value="P">Perempuan</option>
                    <option value="L" selected>Pilih Jenis Kelamin Anda</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="name" id="jabatanLabel" class="block text-sm font-medium text-gray-900">Jabatan</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 flex titikDua">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="jabatan" id="jabatan" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_jabatan hidden">
                      <p class="mt-2 text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> Jabatan tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="name" id="emailLabel" class="block text-sm font-medium text-gray-900">email</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 flex titikDua">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="email" id="email" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_email hidden">
                      <p class="mt-2 text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf!</span> Email tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="name" id="no_phoneLabel" class="block text-sm font-medium text-gray-900">No Telp</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 flex titikDua">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="no_phone" id="no_phone" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_no_phone hidden">
                      <p class="mt-2 text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> No hp tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="name" id="alamatLabel" class="block text-sm font-medium text-gray-900">Alamat</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 flex titikDua">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="alamat" id="alamat" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_alamat hidden">
                      <p class="mt-2 text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> Alamat tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex w-full">
          <div class="ml-auto">
            <button type="button" id="tutupModal2" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
              Tutup
            </button>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
              Simpan
            </button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>
<script>
  $(document).ready(function() {
    $('#formTambahDosen').on("submit", function(e) {
      e.preventDefault();
      var semuaKondisiTerpenuhi = true;

      // Fungsi untuk mengecek dan menangani setiap kondisi
      function handleCondition(inputSelector, errorSelector, titikDuaSelector) {
        if ($(inputSelector).val() == "") {
          $(errorSelector).removeClass('hidden');
          $(titikDuaSelector).addClass('mb-3');
          semuaKondisiTerpenuhi = false;
        } else {
          $(errorSelector).addClass('hidden');
          $(titikDuaSelector).removeClass('mb-3');
        }
      }

      // Memanggil fungsi handleCondition untuk setiap kondisi
      handleCondition('#nama', '.error_msg_nama', '.titikDuaNama');
      handleCondition('#nip', '.error_msg_nip', '.titikDuaNip');
      handleCondition('#ttl', '.error_msg_ttl', '.titikDuaTtl');
      handleCondition('#jabatan', '.error_msg_jabatan', '.titikDuaJabatan');
      handleCondition('#email', '.error_msg_email', '.titikDuaEmail');
      handleCondition('#no_phone', '.error_msg_no_phone', '.titikDuaNoPhone');
      handleCondition('#alamat', '.error_msg_alamat', '.titikDuaAlamat');

      // Memeriksa apakah semua kondisi terpenuhi sebelum menjalankan ajax
      if (semuaKondisiTerpenuhi) {
        // Jalankan ajax di sini
        let formData = new FormData($('#formTambahDosen')[0]);
        $.ajax({
          url: '<?= BASEURL; ?>/Admin/tambahDosen', // Ganti dengan URL tujuan yang sesuai
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            console.log(response);
            // Handle response dari server jika diperlukan
          },
          error: function(error) {
            console.error(error);
            // Handle error jika diperlukan
          }
        });
      } else {
        // Tidak memenuhi semua kondisi, tidak menjalankan ajax
      }

    })
  })
  const dropArea = $('#dropAreaImgDosen');
  const fileInput = $('#imgInputDosen');
  const preview = $('#preview');

  dropArea.on('dragover', function(event) {
    event.preventDefault();
    dropArea.addClass('bg-gray-200');
  });

  dropArea.on('dragleave', function() {
    dropArea.removeClass('bg-gray-200');
  });

  dropArea.on('drop', function(event) {
    event.preventDefault();
    dropArea.removeClass('bg-gray-200');

    const files = event.originalEvent.dataTransfer.files;

    if (files.length > 0) {
      fileInput[0].files = files;
      showImagePreview();
    }
  });

  fileInput.on('change', function() {
    showImagePreview();
  });

  function showImagePreview() {
    const file = fileInput[0].files[0];
    $('#noImgDosen').addClass('hidden');

    if (file) {
      const reader = new FileReader();

      reader.onload = function(e) {
        const img = $('<img>').attr('src', e.target.result);
        preview.empty().append(img);
      };

      reader.readAsDataURL(file);
    }
  }
  const showModal = () => {
    const modal = document.getElementById('static-modal');
    $('.sidebar').addClass('sidebar-backdrop');
    modal.classList.remove('hidden');
  }
  // const modalKompen = document.getElementById('static-modal-kompen');
  //   const showModalKompen = () => {
  //     $('.sidebar').addClass('sidebar-backdrop');
  //     modalKompen.classList.remove('hidden');
  //   }
  // const tutupModalKompen = document.getElementById('tutupModalKompen');
  // const tutupModalKompen2 = document.getElementById('tutupModalKompen2');


  // tutupModalKompen.addEventListener('click', function() {
  //   $('.sidebar').removeClass('sidebar-backdrop');
  //   modalKompen.classList.add('hidden');
  // });
  // tutupModalKompen2.addEventListener('click', function() {
  //   $('.sidebar').removeClass('sidebar-backdrop');
  //   modalKompen.classList.add('hidden');
  // });

  const buttonTambahDosen = document.getElementById('buttonTambahDosen');
  const staticModal = document.getElementById('static-modal');
  const tutupModal = document.getElementById('tutupModal');
  const tutupModa2 = document.getElementById('tutupModal2');



  tutupModal.addEventListener('click', function() {
    $('.sidebar').removeClass('sidebar-backdrop');
    staticModal.classList.add('hidden');
  });
  tutupModa2.addEventListener('click', function() {
    $('.sidebar').removeClass('sidebar-backdrop');
    staticModal.classList.add('hidden');
  });
  $(document).ready(function() {

    $('#tableDosen').DataTable({
      rowReorder: {
        selector: 'td:nth-child(2)'
      },
      lengthChange: false,
      responsive: {
        breakpoints: [{
            name: 'bigdesktop',
            width: Infinity
          },
          {
            name: 'meddesktop',
            width: 1480
          },
          {
            name: 'smalldesktop',
            width: 1280
          },
          {
            name: 'medium',
            width: 1188
          },
          {
            name: 'tabletl',
            width: 1024
          },
          {
            name: 'btwtabllandp',
            width: 848
          },
          {
            name: 'tabletp',
            width: 768
          },
          {
            name: 'mobilel',
            width: 480
          },
          {
            name: 'mobilep',
            width: 320
          }
        ]
      }
    });
    $('#tableDosen_filter').append('<div id="buttonTambahDosen"><a onclick="showModal();"data-modal-toggle="static-modal" href="#" class="bg-green-500 hover:bg-green-700 sm:right-[-100px] text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-plus"></i> Tombol Link</a></div>');

  });
</script>