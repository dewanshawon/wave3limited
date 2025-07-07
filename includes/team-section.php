<?php
// Advanced Team Section with Tabs and Search
?>
<section class="container py-5">
  <h2 class="text-center mb-4 fw-bold">Meet Our Team</h2>
  <div class="mb-4 d-flex justify-content-center">
    <input type="text" id="team-search" class="form-control w-50" placeholder="Search team members..." onkeyup="filterTeamCards()">
  </div>
  <ul class="nav nav-pills justify-content-center mb-4" id="teamTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="admin-tab" data-bs-toggle="pill" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="true">Admin Team</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="marketing-tab" data-bs-toggle="pill" data-bs-target="#marketing" type="button" role="tab" aria-controls="marketing" aria-selected="false">Marketing Team</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="developer-tab" data-bs-toggle="pill" data-bs-target="#developer" type="button" role="tab" aria-controls="developer" aria-selected="false">Developer Team</button>
    </li>
  </ul>
  <div class="tab-content" id="teamTabContent">
    <?php foreach (["admin", "marketing", "developer"] as $cat): ?>
    <div class="tab-pane fade show <?php echo $cat === 'admin' ? 'active' : ''; ?>" id="<?php echo $cat; ?>" role="tabpanel" aria-labelledby="<?php echo $cat; ?>-tab">
      <div class="row g-4" id="<?php echo $cat; ?>-team-cards">
        <?php foreach ($team[$cat] as $member): ?>
        <div class="col-md-6 col-lg-4 team-card-item">
          <div class="card h-100 shadow-sm border-0 team-card-adv">
            <div class="card-body text-center">
              <img src="<?php echo htmlspecialchars($member['photo']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?> photo" class="rounded-circle mb-3 team-photo-adv" style="width: 90px; height: 90px; object-fit: cover; border: 4px solid #2563eb;" onerror="this.onerror=null;this.src='assets/team/default-avatar.png';">
              <h5 class="card-title fw-bold mb-1"><?php echo htmlspecialchars($member['name']); ?></h5>
              <span class="badge bg-primary mb-2"><?php echo htmlspecialchars($member['role']); ?></span>
              <p class="card-text small mb-2"><?php echo htmlspecialchars($member['bio']); ?></p>
              <div class="d-flex justify-content-center gap-2 mb-2">
                <a href="tel:<?php echo htmlspecialchars($member['phone']); ?>" class="btn btn-outline-primary btn-sm" title="Call"><i class="fa fa-phone"></i></a>
                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $member['whatsapp']); ?>" target="_blank" class="btn btn-outline-success btn-sm" title="WhatsApp"><i class="fa fa-whatsapp"></i></a>
              </div>
              <div class="d-flex justify-content-center gap-2">
                <?php if (!empty($member['linkedin'])): ?>
                  <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" class="btn btn-outline-info btn-sm" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                <?php endif; ?>
                <?php if (!empty($member['twitter'])): ?>
                  <a href="<?php echo htmlspecialchars($member['twitter']); ?>" target="_blank" class="btn btn-outline-secondary btn-sm" title="Twitter"><i class="fa fa-twitter"></i></a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<script>
function filterTeamCards() {
  var input = document.getElementById('team-search');
  var filter = input.value.toLowerCase();
  ['admin', 'marketing', 'developer'].forEach(function(cat) {
    var cards = document.querySelectorAll('#' + cat + '-team-cards .team-card-item');
    cards.forEach(function(card) {
      var text = card.textContent.toLowerCase();
      card.style.display = text.includes(filter) ? '' : 'none';
    });
  });
}
</script>
<style>
.team-card-adv { transition: box-shadow 0.3s, transform 0.3s; }
.team-card-adv:hover { box-shadow: 0 8px 32px rgba(37,99,235,0.18); transform: translateY(-6px) scale(1.03); }
.team-photo-adv { box-shadow: 0 2px 8px rgba(37,99,235,0.10); background: #f3f4f6; }
</style> 