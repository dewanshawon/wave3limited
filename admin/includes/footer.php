        </div><!-- /.content-area -->
    </div><!-- /.main-content -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth <= 768 && 
                sidebar && 
                !sidebar.contains(e.target) && 
                !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Confirm delete actions
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });
        
        // Form validation
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(function(field) {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });
        });
        
        // AJAX helper function
        function ajaxRequest(url, data = null, method = 'GET') {
            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.open(method, url);
                xhr.setRequestHeader('Content-Type', 'application/json');
                
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            resolve(response);
                        } catch (e) {
                            resolve(xhr.responseText);
                        }
                    } else {
                        reject(new Error('Request failed with status: ' + xhr.status));
                    }
                };
                
                xhr.onerror = function() {
                    reject(new Error('Request failed'));
                };
                
                if (data && method === 'POST') {
                    xhr.send(JSON.stringify(data));
                } else {
                    xhr.send();
                }
            });
        }
        
        // Refresh dashboard data
        function refreshDashboardData() {
            ajaxRequest('?ajax=dashboard_stats')
                .then(function(data) {
                    // Update stats cards
                    data.forEach(function(stat) {
                        const element = document.getElementById('stat-' + stat.table_name.toLowerCase().replace(/\s+/g, '-'));
                        if (element) {
                            element.textContent = stat.record_count;
                        }
                    });
                })
                .catch(function(error) {
                    console.error('Failed to refresh dashboard data:', error);
                });
        }
        
        // Auto-refresh dashboard every 30 seconds
        if (window.location.search.includes('page=dashboard')) {
            setInterval(refreshDashboardData, 30000);
        }
        
        // Chart.js configuration
        Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
        Chart.defaults.color = '#6c757d';
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Initialize popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
        
        // File upload preview
        document.querySelectorAll('input[type="file"]').forEach(function(input) {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const preview = document.getElementById('file-preview');
                
                if (file && preview) {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.innerHTML = '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px;">';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        preview.innerHTML = '<p class="text-muted">Selected file: ' + file.name + '</p>';
                    }
                }
            });
        });
        
        // Search functionality
        document.querySelectorAll('.search-input').forEach(function(input) {
            input.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const table = document.querySelector(this.dataset.target);
                
                if (table) {
                    const rows = table.querySelectorAll('tbody tr');
                    rows.forEach(function(row) {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                }
            });
        });
        
        // Sortable tables
        document.querySelectorAll('.sortable').forEach(function(table) {
            const headers = table.querySelectorAll('th[data-sort]');
            headers.forEach(function(header) {
                header.addEventListener('click', function() {
                    const column = this.dataset.sort;
                    const tbody = table.querySelector('tbody');
                    const rows = Array.from(tbody.querySelectorAll('tr'));
                    
                    rows.sort(function(a, b) {
                        const aValue = a.querySelector('td[data-' + column + ']')?.dataset[column] || '';
                        const bValue = b.querySelector('td[data-' + column + ']')?.dataset[column] || '';
                        
                        if (this.classList.contains('sort-desc')) {
                            return aValue.localeCompare(bValue);
                        } else {
                            return bValue.localeCompare(aValue);
                        }
                    });
                    
                    this.classList.toggle('sort-desc');
                    rows.forEach(function(row) {
                        tbody.appendChild(row);
                    });
                });
            });
        });
        
        // Export functionality
        function exportTable(tableId, format = 'csv') {
            const table = document.getElementById(tableId);
            if (!table) return;
            
            const rows = Array.from(table.querySelectorAll('tr'));
            let content = '';
            
            if (format === 'csv') {
                rows.forEach(function(row) {
                    const cells = Array.from(row.querySelectorAll('th, td'));
                    const rowData = cells.map(function(cell) {
                        return '"' + cell.textContent.replace(/"/g, '""') + '"';
                    });
                    content += rowData.join(',') + '\n';
                });
                
                const blob = new Blob([content], { type: 'text/csv' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = tableId + '_export.csv';
                a.click();
                window.URL.revokeObjectURL(url);
            }
        }
        
        // Make export function globally available
        window.exportTable = exportTable;
        
        // Print functionality
        function printPage() {
            window.print();
        }
        
        // Make print function globally available
        window.printPage = printPage;
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                const saveBtn = document.querySelector('.btn-save');
                if (saveBtn) saveBtn.click();
            }
            
            // Ctrl/Cmd + N to add new
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                const addBtn = document.querySelector('.btn-add');
                if (addBtn) addBtn.click();
            }
            
            // Escape to close modals
            if (e.key === 'Escape') {
                const modals = document.querySelectorAll('.modal.show');
                modals.forEach(function(modal) {
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) modalInstance.hide();
                });
            }
        });
        
        // Performance monitoring
        window.addEventListener('load', function() {
            if ('performance' in window) {
                const perfData = performance.getEntriesByType('navigation')[0];
                const loadTime = perfData.loadEventEnd - perfData.loadEventStart;
                console.log('Admin panel load time:', loadTime + 'ms');
            }
        });
        
        // Error tracking
        window.addEventListener('error', function(e) {
            console.error('JavaScript error:', e.error);
            // You can send this to your error tracking service
        });
        
        // Unhandled promise rejection tracking
        window.addEventListener('unhandledrejection', function(e) {
            console.error('Unhandled promise rejection:', e.reason);
            // You can send this to your error tracking service
        });
    </script>
</body>
</html>
<footer class="admin-footer mt-4">
    <div class="container-fluid py-3 px-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="background: linear-gradient(90deg, #2563eb 0%, #1e40af 100%); color: #fff; border-top: 1.5px solid #e5e7eb; box-shadow: 0 -2px 8px rgba(0,0,0,0.07);">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <img src="/assets/WAVElogo01.png" alt="Wave 3 Limited Logo" style="height: 36px; width: 36px; border-radius: 8px; background: #fff; margin-right: 0.7rem; box-shadow: 0 2px 8px rgba(37,99,235,0.08);">
            <span class="fw-bold fs-5">Wave 3 Limited Admin</span>
            <span class="ms-3 small d-none d-md-inline" style="opacity:0.8;">Professional Admin Panel</span>
        </div>
        <div class="d-flex align-items-center gap-3 mb-2 mb-md-0">
            <a href="?page=dashboard" class="footer-link text-white text-decoration-none">Dashboard</a>
            <a href="?page=services" class="footer-link text-white text-decoration-none">Services</a>
            <a href="?page=companies" class="footer-link text-white text-decoration-none">Companies</a>
            <a href="?page=team" class="footer-link text-white text-decoration-none">Team</a>
            <a href="?page=settings" class="footer-link text-white text-decoration-none">Settings</a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="mailto:info@wave3limited.com" class="text-white" title="Contact Support"><i class="fas fa-envelope"></i></a>
            <a href="https://facebook.com/wave3limited" target="_blank" class="text-white" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://linkedin.com/company/wave3limited" target="_blank" class="text-white" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://twitter.com/wave3limited" target="_blank" class="text-white" title="Twitter"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
    <div class="container-fluid py-2 px-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="background: #1e293b; color: #cbd5e1; font-size: 0.98rem;">
        <div>&copy; <?php echo date('Y'); ?> Wave 3 Limited. All rights reserved.</div>
        <div class="small">Admin Panel v1.0.0 &mdash; Last updated <?php echo date('Y-m-d'); ?></div>
    </div>
</footer> 