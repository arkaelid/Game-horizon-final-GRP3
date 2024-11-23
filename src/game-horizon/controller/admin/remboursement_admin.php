<?php
namespace Controller\admin;

class remboursement_admin extends \Controller\admin\MainAdmin
{
    public function index()
    {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/loginadmin');
        }

        $remboursementModel = new \Model\admin\remboursement_admin();
        $refunds = $remboursementModel->getAllRefundRequests();
        $pendingCount = $remboursementModel->getPendingRefundsCount();
        
        $this->view->title = 'Gestion des remboursements';
        $this->view->Display('admin/remboursement', [
            'remboursements' => $refunds,
            'pending_count' => $pendingCount
        ]);
    }

    public function viewRefund($vars)
    {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/loginadmin');
        }

        $refundId = $vars["id"] ?? null;
        if (!$refundId) {
            $this->redirect('/admin/remboursement');
        }

        $remboursementModel = new \Model\admin\remboursement_admin();
        $refund = $remboursementModel->getRefundById($refundId);

        if (!$refund) {
            $this->redirect('/admin/remboursement');
        }

        $this->view->title = 'Détail du remboursement';
        $this->view->Display('admin/edit_remboursement', [
            'refund' => $refund
        ]);
    }

    public function acceptRefund($vars)
    {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/loginadmin');
        }

        $refundId = $vars["id"] ?? null;
        if (!$refundId) {
            $this->redirect('/admin/remboursement?error=Demande non trouvée');
        }

        try {
            $remboursementModel = new \Model\admin\remboursement_admin();
            $remboursementModel->acceptRefund($refundId);
            $this->redirect('/admin/remboursement?success=Le remboursement a été accepté');
        } catch (\Exception $e) {
            $this->redirect('/admin/remboursement?error=Erreur lors de l\'acceptation : ' . $e->getMessage());
        }
    }

    public function rejectRefund($vars)
    {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/loginadmin');
        }

        $refundId = $vars["id"] ?? null;
        if (!$refundId) {
            $this->redirect('/admin/remboursement?error=Demande non trouvée');
        }

        try {
            $remboursementModel = new \Model\admin\remboursement_admin();
            $remboursementModel->rejectRefund($refundId);
            $this->redirect('/admin/remboursement?success=Le remboursement a été refusé');
        } catch (\Exception $e) {
            $this->redirect('/admin/remboursement?error=Erreur lors du refus : ' . $e->getMessage());
        }
    }
}
