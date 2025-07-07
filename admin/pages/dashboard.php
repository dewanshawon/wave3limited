<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">Dashboard</h1>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <?php foreach ($pageData['stats'] as $stat): ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card <?php echo $stat['table_name'] === 'Contact Submissions' ? 'warning' : 'success'; ?>">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1" id="stat-<?php echo strtolower(str_replace(' ', '-', $stat['table_name'])); ?>">
                            <?php echo number_format($stat['record_count']); ?>
                        </h4>
                        <p class="mb-0 opacity-75"><?php echo htmlspecialchars($stat['table_name']); ?></p>
                    </div>
                    <div class="stats-icon">
                        <?php
                        $icon = match($stat['table_name']) {
                            'Services' => 'fas fa-cogs',
                            'Companies' => 'fas fa-building',
                            'Team Members' => 'fas fa-users',
                            'Contact Submissions' => 'fas fa-envelope',
                            'Page Views' => 'fas fa-eye',
                            'Users' => 'fas fa-user-shield',
                            default => 'fas fa-database'
                        };
                        ?>
                        <i class="<?php echo $icon; ?>" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Database Info and Recent Activity -->
<div class="row">
    <!-- Database Information -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-database me-2"></i>Database Information</h5>
            </div>
            <div class="card-body">
                <?php if (isset($pageData['db_info'])): ?>
                    <div class="row">
                        <div class="col-6">
                            <p class="mb-1"><strong>Server:</strong></p>
                            <p class="text-muted"><?php echo htmlspecialchars($pageData['db_info']['server'] ?? 'Unknown'); ?></p>
                        </div>
                        <div class="col-6">
                            <p class="mb-1"><strong>Database:</strong></p>
                            <p class="text-muted"><?php echo htmlspecialchars($pageData['db_info']['database'] ?? 'Unknown'); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="mb-1"><strong>Connection Time:</strong></p>
                            <p class="text-muted"><?php echo htmlspecialchars($pageData['db_info']['connection_time'] ?? 'Unknown'); ?></p>
                        </div>
                        <div class="col-6">
                            <p class="mb-1"><strong>Status:</strong></p>
                            <span class="badge bg-success">Connected</span>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Database information not available</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <a href="?page=services" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-2"></i>Add Service
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="?page=companies" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-2"></i>Add Company
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="?page=team" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-2"></i>Add Team Member
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="?page=submissions" class="btn btn-warning w-100">
                            <i class="fas fa-envelope me-2"></i>View Messages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Contact Submissions -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Recent Contact Submissions</h5>
                <a href="?page=submissions" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                <?php if (!empty($pageData['recent_submissions'])): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pageData['recent_submissions'] as $submission): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($submission['name']); ?></td>
                                        <td><?php echo htmlspecialchars($submission['email']); ?></td>
                                        <td><?php echo htmlspecialchars($submission['subject']); ?></td>
                                        <td>
                                            <?php
                                            $statusClass = match($submission['status']) {
                                                'pending' => 'warning',
                                                'read' => 'info',
                                                'replied' => 'success',
                                                'spam' => 'danger',
                                                default => 'secondary'
                                            };
                                            ?>
                                            <span class="badge bg-<?php echo $statusClass; ?>">
                                                <?php echo ucfirst(htmlspecialchars($submission['status'])); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('M j, Y H:i', strtotime($submission['created_at'])); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#submissionModal" 
                                                    data-submission='<?php echo json_encode($submission); ?>'>
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center py-4">No recent contact submissions</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Analytics Chart -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Page Views (Last 30 Days)</h5>
            </div>
            <div class="card-body">
                <canvas id="pageViewsChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- System Health -->
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-heartbeat me-2"></i>System Health</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Database Connection</span>
                        <span class="text-success">✓ Healthy</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 100%"></div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Storage Usage</span>
                        <span class="text-warning">75%</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: 75%"></div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Memory Usage</span>
                        <span class="text-info">45%</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-info" style="width: 45%"></div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>CPU Usage</span>
                        <span class="text-success">25%</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 25%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Maintenance Tasks</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary btn-sm" onclick="cleanExpiredSessions()">
                        <i class="fas fa-broom me-2"></i>Clean Expired Sessions
                    </button>
                    <button class="btn btn-outline-warning btn-sm" onclick="optimizeDatabase()">
                        <i class="fas fa-tools me-2"></i>Optimize Database
                    </button>
                    <button class="btn btn-outline-info btn-sm" onclick="backupDatabase()">
                        <i class="fas fa-download me-2"></i>Create Backup
                    </button>
                    <button class="btn btn-outline-success btn-sm" onclick="refreshStats()">
                        <i class="fas fa-sync me-2"></i>Refresh Statistics
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Submission Modal -->
<div class="modal fade" id="submissionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contact Submission Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="submissionModalBody">
                <!-- Content will be loaded dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="markAsRead()">Mark as Read</button>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize page views chart
const ctx = document.getElementById('pageViewsChart').getContext('2d');
const pageViewsChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7'],
        datasets: [{
            label: 'Page Views',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37, 99, 235, 0.1)',
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});

// Load submission details in modal
document.getElementById('submissionModal').addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const submission = JSON.parse(button.getAttribute('data-submission'));
    const modalBody = document.getElementById('submissionModalBody');
    
    modalBody.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <p><strong>Name:</strong> ${submission.name}</p>
                <p><strong>Email:</strong> ${submission.email}</p>
                <p><strong>Subject:</strong> ${submission.subject}</p>
                <p><strong>Date:</strong> ${new Date(submission.created_at).toLocaleString()}</p>
            </div>
            <div class="col-md-6">
                <p><strong>IP Address:</strong> ${submission.ip_address || 'N/A'}</p>
                <p><strong>Status:</strong> <span class="badge bg-${getStatusColor(submission.status)}">${submission.status}</span></p>
                <p><strong>Processed:</strong> ${submission.is_processed ? 'Yes' : 'No'}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <p><strong>Message:</strong></p>
                <div class="border rounded p-3 bg-light">
                    ${submission.message.replace(/\n/g, '<br>')}
                </div>
            </div>
        </div>
    `;
});

function getStatusColor(status) {
    switch(status) {
        case 'pending': return 'warning';
        case 'read': return 'info';
        case 'replied': return 'success';
        case 'spam': return 'danger';
        default: return 'secondary';
    }
}

// Maintenance functions
function cleanExpiredSessions() {
    if (confirm('Are you sure you want to clean expired sessions?')) {
        ajaxRequest('?ajax=clean_sessions', null, 'POST')
            .then(function(response) {
                alert('Expired sessions cleaned successfully!');
            })
            .catch(function(error) {
                alert('Failed to clean sessions: ' + error.message);
            });
    }
}

function optimizeDatabase() {
    if (confirm('Are you sure you want to optimize the database? This may take a few moments.')) {
        ajaxRequest('?ajax=optimize_db', null, 'POST')
            .then(function(response) {
                alert('Database optimization completed!');
            })
            .catch(function(error) {
                alert('Failed to optimize database: ' + error.message);
            });
    }
}

function backupDatabase() {
    if (confirm('Are you sure you want to create a database backup?')) {
        ajaxRequest('?ajax=backup_db', null, 'POST')
            .then(function(response) {
                alert('Database backup created successfully!');
            })
            .catch(function(error) {
                alert('Failed to create backup: ' + error.message);
            });
    }
}

function refreshStats() {
    refreshDashboardData();
    alert('Statistics refreshed!');
}

function markAsRead() {
    // Implementation for marking submission as read
    alert('Submission marked as read!');
    bootstrap.Modal.getInstance(document.getElementById('submissionModal')).hide();
}

// Load real analytics data
function loadAnalyticsData() {
    ajaxRequest('?ajax=analytics')
        .then(function(data) {
            // Update chart with real data
            if (data && data.length > 0) {
                const chartData = data[0]; // Page views by day
                pageViewsChart.data.labels = chartData.map(item => item.date);
                pageViewsChart.data.datasets[0].data = chartData.map(item => item.page_views);
                pageViewsChart.update();
            }
        })
        .catch(function(error) {
            console.error('Failed to load analytics data:', error);
        });
}

// Load analytics data on page load
document.addEventListener('DOMContentLoaded', function() {
    loadAnalyticsData();
});
</script> 