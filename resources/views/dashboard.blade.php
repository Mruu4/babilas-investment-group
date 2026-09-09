<x-layouts.admin title="Dashboard">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-big-navy-dark">Welcome back, {{ auth()->user()->name }}</h2>
            <p class="text-gray-500 text-sm mt-1">Portfolio overview and management — {{ now()->format('M j, Y \a\t g:i A') }}</p>
        </div>
        <div class="flex items-center gap-2 px-3 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg self-start">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-emerald-700 text-xs font-semibold">Live Data</span>
        </div>
    </div>

    {{-- KPI Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @php
            $colorMap = [
                'sky' => 'bg-sky-500/15 text-sky-400',
                'emerald' => 'bg-emerald-500/15 text-emerald-400',
                'violet' => 'bg-violet-500/15 text-violet-400',
                'orange' => 'bg-orange-500/15 text-orange-400',
                'gold' => 'bg-big-gold-dark/15 text-big-gold-light',
                'pink' => 'bg-pink-500/15 text-pink-400',
                'cyan' => 'bg-cyan-500/15 text-cyan-400',
                'red' => 'bg-red-500/15 text-red-400',
            ];
        @endphp
        @foreach ($cards as $card)
        <a href="{{ $card['href'] }}"
           class="p-5 rounded-xl border transition-all group block
                  {{ ($card['alert'] ?? false) ? 'bg-red-950/40 border-red-500/30 hover:border-red-500/50' : 'bg-big-navy border-white/10 hover:border-big-gold-dark/40' }}">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl {{ $colorMap[$card['color']] }} flex items-center justify-center">
                    <i data-lucide="{{ ($card['alert'] ?? false) ? 'alert-triangle' : $card['icon'] }}" class="w-5 h-5"></i>
                </div>
                <i data-lucide="eye" class="w-3.5 h-3.5 text-slate-500 opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </div>
            <div class="mb-3">
                <p class="text-white font-bold text-3xl leading-none">{{ $card['value'] }}</p>
                <p class="text-slate-400 text-xs mt-1.5 font-medium">{{ $card['subValue'] }}</p>
            </div>
            <p class="text-slate-300 text-sm font-semibold mb-2">{{ $card['label'] }}</p>
            <p class="text-xs {{ ($card['alert'] ?? false) ? 'text-red-400 font-medium' : 'text-slate-500' }} border-t border-white/10 pt-2 mt-2 leading-relaxed">
                {{ $card['note'] }}
            </p>
        </a>
        @endforeach
    </div>

    @if (array_sum($stats) === 0)
    <div class="bg-white rounded-xl border border-slate-200 p-8 text-center flex flex-col items-center justify-center min-h-[240px]">
        <div class="p-4 bg-big-gold/10 rounded-full text-big-gold-dark mb-3">
            <i data-lucide="bar-chart-3" class="w-8 h-8"></i>
        </div>
        <h3 class="text-base font-semibold text-slate-800">No Analytics Data Yet</h3>
        <p class="text-sm text-slate-500 max-w-md mt-1 mb-4">
            Your key performance metrics, investment distribution, and enquiry trends will appear here once content modules are populated.
        </p>
        <a href="{{ route('admin.properties.create') }}" class="bg-big-navy-dark hover:bg-big-navy text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            Add First Data Entry
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6"
         x-data="{
            tab: 'enquiries',
            trendData: {{ $enquiriesTrend->pluck('count')->toJson() }},
            trendLabels: {{ $enquiriesTrend->pluck('label')->toJson() }},
            distData: {{ collect($distribution)->values()->toJson() }},
            distLabels: {{ collect($distribution)->keys()->toJson() }},
            distColors: ['#C9A227','#10B981','#8B5CF6','#F97316','#38BDF8'],
            barChart: null,
            pieChart: null,
            navyTooltip(context, unitLabel) {
                let el = document.getElementById('chart-tooltip');
                if (!el) {
                    el = document.createElement('div');
                    el.id = 'chart-tooltip';
                    el.className = 'pointer-events-none absolute z-50 bg-big-navy border border-big-gold-dark/20 rounded-xl p-3 shadow-2xl transition-opacity';
                    document.body.appendChild(el);
                }
                const tt = context.tooltip;
                if (tt.opacity === 0) { el.style.opacity = 0; return; }
                const dp = tt.dataPoints[0];
                el.innerHTML = `
                    <p class='text-big-gold-light font-semibold text-sm mb-1'>${dp.label}</p>
                    <p class='text-white font-bold text-lg'>${dp.formattedValue} ${unitLabel}</p>
                `;
                const pos = context.chart.canvas.getBoundingClientRect();
                el.style.opacity = 1;
                el.style.left = pos.left + window.scrollX + tt.caretX + 12 + 'px';
                el.style.top = pos.top + window.scrollY + tt.caretY - 10 + 'px';
            },
            initCharts() {
                const ctx = this.$refs.canvas.getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 280);
                gradient.addColorStop(0, '#E5C45C');
                gradient.addColorStop(1, 'rgba(201,162,39,0.65)');

                const bg = this.trendData.map((_, i) => i === this.trendData.length - 1 ? '#E5C45C' : gradient);

                this.barChart = new Chart(ctx, {
                    type: 'bar',
                    data: { labels: this.trendLabels, datasets: [{ data: this.trendData, backgroundColor: bg, borderRadius: 6, maxBarThickness: 32 }] },
                    options: {
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false, external: (c) => this.navyTooltip(c, 'enquiries') },
                        },
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0, color: '#64748B' }, grid: { color: 'rgba(255,255,255,0.05)' } },
                            x: { ticks: { color: '#64748B' }, grid: { display: false } },
                        },
                    }
                });
            },
            showDistribution() {
                if (this.barChart) { this.barChart.destroy(); this.barChart = null; }
                const ctx = this.$refs.canvas.getContext('2d');
                const total = this.distData.reduce((a, b) => a + b, 0) || 1;
                this.pieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: { labels: this.distLabels, datasets: [{ data: this.distData, backgroundColor: this.distColors, borderWidth: 0, spacing: 3 }] },
                    options: {
                        cutout: '62%',
                        plugins: {
                            legend: { position: 'bottom', labels: { color: '#94A3B8', boxWidth: 10, font: { size: 11 }, padding: 14 } },
                            tooltip: {
                                enabled: false,
                                external: (c) => {
                                    if (c.tooltip.dataPoints?.length) {
                                        const dp = c.tooltip.dataPoints[0];
                                        const pct = Math.round((dp.raw / total) * 100);
                                        c.tooltip.dataPoints[0].formattedValue = `${dp.raw} items (${pct}%)`;
                                    }
                                    this.navyTooltip(c, '');
                                }
                            },
                        },
                    }
                });
            },
            showTrend() {
                if (this.pieChart) { this.pieChart.destroy(); this.pieChart = null; }
                this.initCharts();
            }
         }"
         x-init="$nextTick(() => initCharts())">

        {{-- Chart card --}}
        <div class="lg:col-span-2 bg-big-navy rounded-xl border border-white/10 p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
                <div>
                    <h3 class="text-white font-semibold text-base">Analytics Overview</h3>
                    <p class="text-slate-500 text-xs mt-0.5">Last 6 months</p>
                </div>
                <div class="flex items-center gap-1 bg-big-navy-light rounded-lg p-1 self-start">
                    <button @click="tab = 'enquiries'; showTrend()"
                            :class="tab === 'enquiries' ? 'bg-big-gold-dark/20 text-big-gold-light' : 'text-slate-500 hover:text-slate-300'"
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold transition-all">
                        <i data-lucide="trending-up" class="w-3 h-3"></i> Enquiries Trend
                    </button>
                    <button @click="tab = 'distribution'; showDistribution()"
                            :class="tab === 'distribution' ? 'bg-big-gold-dark/20 text-big-gold-light' : 'text-slate-500 hover:text-slate-300'"
                            class="flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold transition-all">
                        <i data-lucide="pie-chart" class="w-3 h-3"></i> Investment Distribution
                    </button>
                </div>
            </div>
            <div class="h-72">
                <canvas x-ref="canvas"></canvas>
            </div>
            <div x-show="tab === 'distribution'" x-cloak class="mt-4 grid grid-cols-5 gap-2">
                <template x-for="(label, i) in distLabels" :key="label">
                    <div class="text-center">
                        <div class="w-2 h-2 rounded-full mx-auto mb-1" :style="`background-color: ${distColors[i]}`"></div>
                        <p class="text-slate-500 text-xs leading-tight" x-text="label"></p>
                        <p class="text-white text-xs font-semibold mt-0.5" x-text="Math.round((distData[i] / (distData.reduce((a,b)=>a+b,0) || 1)) * 100) + '%'"></p>
                    </div>
                </template>
            </div>
        </div>

        {{-- Activity feed --}}
        <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-slate-800 font-semibold text-base">Recent Activity</h3>
                    <p class="text-slate-400 text-xs mt-0.5">Latest updates</p>
                </div>
            </div>
            @if ($activity->isEmpty())
                <p class="text-sm text-slate-400 text-center py-8">No activity yet.</p>
            @else
            <div class="space-y-3">
                @php
                    $iconColorMap = ['sky' => 'text-sky-600 bg-sky-50', 'red' => 'text-red-600 bg-red-50'];
                @endphp
                @foreach ($activity as $item)
                <div class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-slate-50 transition">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 {{ $iconColorMap[$item['color']] }}">
                        <i data-lucide="{{ $item['icon'] }}" class="w-3.5 h-3.5"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-slate-800 text-xs font-semibold leading-tight">{{ $item['action'] }}</p>
                        <p class="text-slate-500 text-xs mt-0.5 truncate">{{ $item['subject'] }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-slate-400 text-xs">{{ $item['time']->diffForHumans() }}</span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span class="text-slate-400 text-xs">{{ $item['user'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    @endif

</x-layouts.admin>
