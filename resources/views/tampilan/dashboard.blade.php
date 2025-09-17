<div class="max-w-6xl mx-auto mt-6 p-6 bg-white bordershadow border rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border">
        <!-- Ringkasan Kinerja -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-1">Ringkasan Kinerja</h2>
            <p class="text-sm text-gray-500 mb-3">Perbandingan rencana dan realisasi survei per triwulan</p>
            <div class="flex justify-center">
                <canvas id="kinerjaChart"></canvas>
            </div>
            <!-- Label -->
            <div class="flex gap-4 mt-3 text-sm justify-center">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-blue-900"></span> Rencana Survei
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-emerald-500"></span> Realisasi Survei
                </div>
            </div>
        </div>
        <!-- Statistik Tahapan per Triwulan -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-1">Ringkasan Kinerja</h2>
            <p class="text-sm text-gray-500 mb-3">Perbandingan rencana dan realisasi survei per triwulan</p>
            <div class="justify-center">
                <canvas id="tahapanChart"></canvas>
            </div>
            <!-- Label I -->
            <div class="flex gap-4 mt-3 text-sm justify-center">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-blue-900"></span> Total Tahapan
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-emerald-500"></span> Tahapan Selesai
                </div>
            </div>
            <!-- Label II -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-center mt-4 text-sm">
                <div class="bg-gray-50 p-2 rounded-lg">
                    <p class="font-bold">Q1</p>
                    <p>4/4</p>
                    <p class="text-green-600">100% selesai</p>
                </div>
                <div class="bg-gray-50 p-2 rounded-lg">
                    <p class="font-bold">Q2</p>
                    <p>2/3</p>
                    <p class="text-yellow-600">67% selesai</p>
                </div>
                <div class="bg-gray-50 p-2 rounded-lg">
                    <p class="font-bold">Q3</p>
                    <p>1/2</p>
                    <p class="text-orange-600">50% selesai</p>
                </div>
                <div class="bg-gray-50 p-2 rounded-lg">
                    <p class="font-bold">Q4</p>
                    <p>0/1</p>
                    <p class="text-red-600">0% selesai</p>
                </div>
            </div>
        </div>
        <!-- Proporsi Publikasi vs Tahapan Selesai -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="font-semibold mb-2">Proporsi Publikasi vs Tahapan Selesai</h2>
            <p class="text-sm text-gray-500 mb-3">Perbandingan jumlah publikasi selesai dengan tahapan selesa</p>
            <div class="justify-center">
                <canvas id="ringChart" width="100" height="100"></canvas>
            </div>
            <!-- Label II -->
            <div class="grid grid-cols-2 gap-2 text-center mt-4 text-sm">
                <div class="bg-gray-50 p-2 rounded-lg">
                    <p class="text-emerald-600 text-lg font-bold">0</p>
                    <p class="text-gray-500 text-xs">Publikasi Selesai</p>
                    <p class="text-gray-500 text-xs">dari 2 total publikasi</p>
                </div>
                <div class="bg-gray-50 p-2 rounded-lg">
                    <p class="text-blue-900 text-lg font-bold">7</p>
                    <p class="text-gray-500 text-xs">Tahapan Selesai</p>
                    <p class="text-gray-500 text-xs">dari 10 total tahapan</p>
                </div>
            </div>
        </div>
    </div>
</div>