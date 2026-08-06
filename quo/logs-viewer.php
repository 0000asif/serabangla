<?php
/**
 * Webhook Logs Viewer
 * File: logs-viewer.php
 * 
 * ব্রাউজারে লগ দেখার জন্য
 */

$logFile = __DIR__ . '/webhook-logs.json';
$logs = [];

if (file_exists($logFile)) {
    $content = file_get_contents($logFile);
    if (!empty($content)) {
        $logs = json_decode($content, true) ?? [];
    }
}

// সার্চ ফিল্টার
$filter = $_GET['filter'] ?? '';
if ($filter) {
    $logs = array_filter($logs, function($log) use ($filter) {
        return stripos($log['event_type'] ?? '', $filter) !== false;
    });
}

// পেজিনেশন
$page = $_GET['page'] ?? 1;
$perPage = 20;
$total = count($logs);
$totalPages = ceil($total / $perPage);
$logs = array_reverse($logs);
$logs = array_slice($logs, ($page - 1) * $perPage, $perPage);
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quo Webhook Logs Viewer</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            padding: 20px;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        h1 {
            color: #1a1a2e;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .stats {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .stat-box {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 8px;
            flex: 1;
            min-width: 150px;
        }
        .stat-box .label {
            color: #6c757d;
            font-size: 0.9em;
        }
        .stat-box .value {
            font-size: 1.8em;
            font-weight: bold;
            color: #1a1a2e;
        }
        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .filters input, .filters select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .filters button {
            padding: 8px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .filters button:hover {
            background: #0056b3;
        }
        .log-entry {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .log-entry:hover {
            background: #e9ecef;
        }
        .log-entry .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        .log-entry .timestamp {
            color: #6c757d;
            font-size: 0.9em;
        }
        .log-entry .event-type {
            font-weight: bold;
            color: #007bff;
            padding: 3px 10px;
            background: #e3f2fd;
            border-radius: 12px;
            font-size: 0.9em;
        }
        .log-entry .event-id {
            color: #6c757d;
            font-size: 0.8em;
            font-family: monospace;
        }
        .log-entry .message {
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 5px;
            border: 1px solid #e9ecef;
        }
        .log-entry .details {
            margin-top: 10px;
        }
        .log-entry .details summary {
            cursor: pointer;
            color: #007bff;
            font-weight: 500;
        }
        .log-entry .details pre {
            background: #1a1a2e;
            color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            overflow: auto;
            font-size: 12px;
            margin-top: 10px;
            max-height: 400px;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .pagination a {
            padding: 8px 15px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #1a1a2e;
        }
        .pagination a.active {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }
        .pagination a:hover {
            background: #e9ecef;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.8em;
            font-weight: 500;
        }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        
        @media (max-width: 768px) {
            .stat-box { min-width: 100%; }
            .log-entry .header { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Quo Webhook Logs</h1>
        
        <!-- Statistics -->
        <div class="stats">
            <div class="stat-box">
                <div class="label">Total Events</div>
                <div class="value"><?= $total ?></div>
            </div>
            <div class="stat-box">
                <div class="label">Last 24 Hours</div>
                <div class="value">
                    <?php 
                    $last24h = array_filter($logs, function($log) {
                        return strtotime($log['timestamp'] ?? '') > strtotime('-24 hours');
                    });
                    echo count($last24h);
                    ?>
                </div>
            </div>
            <div class="stat-box">
                <div class="label">Unique Events</div>
                <div class="value">
                    <?php 
                    $types = array_unique(array_column($logs, 'event_type'));
                    echo count($types);
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="filters">
            <input type="text" id="filterInput" placeholder="Filter by event type..." value="<?= htmlspecialchars($filter) ?>">
            <button onclick="applyFilter()">Search</button>
            <button onclick="clearFilter()">Clear</button>
            <button onclick="refreshLogs()" style="background: #28a745;">🔄 Refresh</button>
        </div>
        
        <!-- Logs -->
        <?php if (empty($logs)): ?>
            <div style="text-align: center; padding: 40px; color: #6c757d;">
                <h3>No logs found</h3>
                <p>Wait for webhook events to arrive</p>
            </div>
        <?php else: ?>
            <?php foreach ($logs as $log): ?>
                <div class="log-entry">
                    <div class="header">
                        <div>
                            <span class="event-type"><?= htmlspecialchars($log['event_type'] ?? 'unknown') ?></span>
                            <span class="event-id">ID: <?= htmlspecialchars($log['event_id'] ?? 'N/A') ?></span>
                        </div>
                        <span class="timestamp"><?= htmlspecialchars($log['timestamp'] ?? 'N/A') ?></span>
                    </div>
                    
                    <?php if (isset($log['payload']['data']['resource']['text'])): ?>
                        <div class="message">
                            💬 <?= htmlspecialchars($log['payload']['data']['resource']['text']) ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="details">
                        <summary onclick="toggleDetails(this)">▶ View Full Details</summary>
                        <pre style="display: none;"><?= json_encode($log, JSON_PRETTY_PRINT) ?></pre>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page-1 ?>&filter=<?= urlencode($filter) ?>">← Previous</a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>&filter=<?= urlencode($filter) ?>" class="<?= $i == $page ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?= $page+1 ?>&filter=<?= urlencode($filter) ?>">Next →</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <script>
        function applyFilter() {
            const filter = document.getElementById('filterInput').value;
            window.location.href = '?filter=' + encodeURIComponent(filter);
        }
        
        function clearFilter() {
            window.location.href = window.location.pathname;
        }
        
        function refreshLogs() {
            window.location.reload();
        }
        
        function toggleDetails(el) {
            const pre = el.parentElement.querySelector('pre');
            if (pre.style.display === 'none') {
                pre.style.display = 'block';
                el.textContent = '▼ Hide Details';
            } else {
                pre.style.display = 'none';
                el.textContent = '▶ View Full Details';
            }
        }
    </script>
</body>
</html>
