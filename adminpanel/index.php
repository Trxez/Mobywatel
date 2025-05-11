<?php
session_start();

// this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek -->  https://vacban.wtf/vacshop/78615/

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['username'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

function getGeneratedApps() {
    $apps = [];
    $directories = glob('../demObywatel_*', GLOB_ONLYDIR);
    
    foreach ($directories as $dir) {
        $dirName = basename($dir);
        $parts = explode('_', $dirName);
        
        if (count($parts) >= 3) {
            $username = $parts[1];
            $firstName = $parts[2];
            $createDate = date("Y-m-d H:i:s", filemtime($dir));
            
            $apps[] = [
                'dir' => $dirName,
                'username' => $username,
                'firstName' => $firstName,
                'createDate' => $createDate
            ];
        }
    }
    
    usort($apps, function($a, $b) {
        return strtotime($b['createDate']) - strtotime($a['createDate']);
    });
    
    return $apps;
}
// this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek -->  https://vacban.wtf/vacshop/78615/
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $dirToDelete = '../' . basename($_GET['delete']);
    if (file_exists($dirToDelete) && is_dir($dirToDelete)) {
		
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dirToDelete, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        
        rmdir($dirToDelete);
        
        header("Location: index.php?tab=apps&deleted=true");
        exit;
    }
}

$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'apps';

$apps = getGeneratedApps();

$userStats = [];
foreach ($apps as $app) {
    $username = $app['username'];
    if (!isset($userStats[$username])) {
        $userStats[$username] = 0;
    }
    $userStats[$username]++;
}
arsort($userStats);

$users = [];
$loginContent = file_get_contents('../login.php');
preg_match_all('/\"([a-zA-Z0-9_]+)\"\s*=>\s*\"([^\"]+)\"/', $loginContent, $matches, PREG_SET_ORDER);
foreach ($matches as $match) {
    $users[$match[1]] = $match[2];
}
// this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek -->  https://vacban.wtf/vacshop/78615/
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>demObywatel | Panel Administratora</title>
    <link rel="stylesheet" href="../dashboard.css">
    <link rel="stylesheet" href="adminpanel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-left">
            <h1>demObywatel | Panel Administratora</h1>
            <p>Panel Administratora</p>
        </div>
        <div class="header-right">
            <a href="../dashboard.php" id="logout-btn">Dashboard <i class="fas fa-tachometer-alt"></i></a>
            <a href="../logout.php" id="logout-btn">Logout <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </header>
    
    <div class="content">
        <div class="tabs">
            <a href="?tab=apps" class="tab <?php echo $activeTab == 'apps' ? 'active' : ''; ?>">
                <i class="fas fa-mobile-alt"></i> Aplikacje
            </a>
            <a href="?tab=users" class="tab <?php echo $activeTab == 'users' ? 'active' : ''; ?>">
                <i class="fas fa-users"></i> Zarządzanie użytkownikami
            </a>
            <a href="?tab=stats" class="tab <?php echo $activeTab == 'stats' ? 'active' : ''; ?>">
                <i class="fas fa-chart-bar"></i> Statystyki 
            </a>
        </div>
        
        <div class="tab-content">
            <?php if ($activeTab == 'apps'): ?>
                <div class="section-header">
                    <h2><i class="fas fa-mobile-alt"></i>Aplikacje</h2>
                    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true'): ?>
                        <div class="alert success">Pomyślnie usunięto aplikacje.</div>
                    <?php endif; ?>
                </div>
                
                <div class="search-bar">
                    <input type="text" id="appSearch" placeholder="Wyszukaj aplikacji...">
                    <i class="fas fa-search"></i>
                </div>
                
                <?php if (empty($apps)): ?>
                    <div class="no-data">Brak aplikacji.</div>
                <?php else: ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nazwa folderu</th>
                                <th>Utworzone przez</th>
                                <th>Imię</th>
                                <th>Stworzona</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
						 <!-- this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek  https://vacban.wtf/vacshop/78615/ -->
                        <tbody>
                            <?php foreach ($apps as $app): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($app['dir']); ?></td>
                                    <td><?php echo htmlspecialchars($app['username']); // this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek -->  https://vacban.wtf/vacshop/78615/?></td>
                                    <td><?php echo htmlspecialchars($app['firstName']); ?></td>
                                    <td><?php echo htmlspecialchars($app['createDate']); ?></td>
                                    <td>
                                        <a href="../<?php echo $app['dir']; ?>" class="action-btn view" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="?tab=apps&delete=<?php echo urlencode($app['dir']); ?>" 
                                           class="action-btn delete" 
                                           onclick="return confirm('Czy na pewno chcesz usunąć tą aplikacje?');" 
                                           title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                
            <?php elseif ($activeTab == 'users'): ?>
                <div class="section-header">
                    <h2><i class="fas fa-users"></i> Zarządzanie użytkownikami</h2>
                    <?php if (isset($_GET['user_added']) && $_GET['user_added'] == 'true'): ?>
                        <div class="alert success">Pomyślnie dodano użytkownika.</div>
                    <?php elseif (isset($_GET['user_deleted']) && $_GET['user_deleted'] == 'true'): ?>
                        <div class="alert success">Pomyślnie usunięto użytkownika.</div>
                    <?php elseif (isset($_GET['error'])): ?>
                        <div class="alert error"><?php echo htmlspecialchars($_GET['error']); ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="card">
                    <h3>Dodawanie nowego użytkownika</h3>
                    <form action="user_actions.php" method="post">
                        <input type="hidden" name="action" value="add">
                        <div class="form-group">
                            <label for="new_username">Username:</label>
                            <input type="text" id="new_username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">Auth Key:</label>
                            <input type="text" id="new_password" name="password" required>
                        </div>
                        <button type="submit" class="btn primary">Dodaj</button>
                    </form>
                </div>
                <!-- this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek https://vacban.wtf/vacshop/78615/ -->
                <div class="card mt-4">
                    <h3>Użytkownicy</h3>
                    <?php if (empty($users)): ?>
                        <div class="no-data">Brak użytkowników.</div>
                    <?php else: ?>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Auth Key</th>
                                    <th>Stworzonych aplikacji</th>
                                    <th>Akcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $username => $password): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($username); ?></td>
                                        <td>
                                            <span class="password-mask">••••••••</span>
                                            <button class="btn small toggle-password" data-password="<?php echo htmlspecialchars($password); ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <td><?php echo isset($userStats[$username]) ? $userStats[$username] : 0; ?></td>
                                        <td>
                                            <?php if ($username !== 'admin'): ?>
                                                <a href="user_actions.php?action=delete&username=<?php echo urlencode($username); ?>" 
                                                   class="action-btn delete" 
                                                   onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');" 
                                                   title="Usunięcie">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            <?php else: ?>
                                                <span class="admin-badge">Administrator</span>
                                            <?php endif; // this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek -->  https://vacban.wtf/vacshop/78615/?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
                
            <?php elseif ($activeTab == 'stats'): ?>
                <div class="section-header">
                    <h2><i class="fas fa-chart-bar"></i>Statystyki</h2>
                </div>
                
                <div class="stats-container">
                    <div class="stat-card">
                        <i class="fas fa-mobile-alt stat-icon"></i>
                        <div class="stat-details">
                            <span class="stat-value"><?php echo count($apps); ?></span>
                            <span class="stat-label">Ilość aplikacji</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <i class="fas fa-users stat-icon"></i>
                        <div class="stat-details">
                            <span class="stat-value"><?php echo count($users); ?></span>
                            <span class="stat-label">Zarejestrowane osoby</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const passwordField = this.previousElementSibling;
                    const icon = this.querySelector('i');
                    
                    if (passwordField.classList.contains('password-mask')) {
                        passwordField.textContent = this.dataset.password;
                        passwordField.classList.remove('password-mask');
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordField.textContent = '••••••••';
                        passwordField.classList.add('password-mask');
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
            
            const searchInput = document.getElementById('appSearch');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const filter = this.value.toLowerCase();
                    const table = document.querySelector('.data-table');
                    const rows = table.querySelectorAll('tbody tr');
                    
                    rows.forEach(function(row) {
                        const cells = row.querySelectorAll('td');
                        let found = false;
                        
                        cells.forEach(function(cell) {
                            if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                                found = true;
                            }
                        });
                        // this file was created by the user "kaprolek", was modified and is owned by magiczny_jasiek -->  https://vacban.wtf/vacshop/78615/
                        row.style.display = found ? '' : 'none';
                    });
                });
            }
        });
    </script>
</body>
</html>