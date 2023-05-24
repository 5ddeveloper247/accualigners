<?php

namespace App\Observers;

use App\Models\CaseModel;

class CaseObserver
{
    /**
     * Handle the CaseModel "created" event.
     *
     * @param  \App\Models\CaseModel  $caseModel
     * @return void
     */
    public function created(CaseModel $caseModel)
    {
        $caseModel->arch_to_treat = strtoupper($caseModel->arch_to_treat);
        $caseModel->a_p_relationship = strtoupper($caseModel->a_p_relationship);
        $caseModel->overjet = strtoupper($caseModel->overjet);
        $caseModel->overbite = strtoupper($caseModel->overbite);
        $caseModel->midline = strtoupper($caseModel->midline);
        $caseModel->save();
    }

    /**
     * Handle the CaseModel "updated" event.
     *
     * @param  \App\Models\CaseModel  $caseModel
     * @return void
     */
    public function updated(CaseModel $caseModel)
    {
        $caseModel->arch_to_treat = strtoupper($caseModel->arch_to_treat);
        $caseModel->a_p_relationship = strtoupper($caseModel->a_p_relationship);
        $caseModel->overjet = strtoupper($caseModel->overjet);
        $caseModel->overbite = strtoupper($caseModel->overbite);
        $caseModel->midline = strtoupper($caseModel->midline);
    }

    /**
     * Handle the CaseModel "deleted" event.
     *
     * @param  \App\Models\CaseModel  $caseModel
     * @return void
     */
    public function deleted(CaseModel $caseModel)
    {
        //
    }

    /**
     * Handle the CaseModel "restored" event.
     *
     * @param  \App\Models\CaseModel  $caseModel
     * @return void
     */
    public function restored(CaseModel $caseModel)
    {
        //
    }

    /**
     * Handle the CaseModel "force deleted" event.
     *
     * @param  \App\Models\CaseModel  $caseModel
     * @return void
     */
    public function forceDeleted(CaseModel $caseModel)
    {
        //
    }
}
