<?php /*
    MRTG Configuration Templates

    Please see: https://github.com/inex/IXP-Manager/wiki/MRTG---Traffic-Graphs

    You should not need to edit these files - instead use your own custom skins. If
    you can't effect the changes you need with skinning, consider posting to the mailing
    list to see if it can be achieved / incorporated.

    Skinning: https://github.com/inex/IXP-Manager/wiki/Skinning */
?>

#####################################################################################################################
#####################################################################################################################
#####################################################################################################################
###
###
###
### AGGREGATE GRAPHS
###
### Source:    <?php echo $this->path() . "\n"; ?>
###
#####################################################################################################################
#####################################################################################################################
#####################################################################################################################

<?php
    foreach( $data['infras'] as $infraid => $infra ):

        if( !isset( $data['infraports'][$infra->getId()] ) ):
            continue;
        endif;

        $this->insert(
            "services/grapher/mrtg/target", [
                'trafficTypes' => \IXP\Utils\Grapher\Mrtg::TRAFFIC_TYPES,
                'mrtgPrefix'   => sprintf( "ixp%03d_infra%03d", $ixp->getId(), $infra->getId() ),
                'portIds'      => $data['infraports'][$infra->getId()],
                'data'         => $data,
                'graphTitle'   => sprintf( config('identity.orgname') . " %%s / second on %s", $infra->getName() ),
                'directory'    => sprintf( "infras/%03d", $infraid ),
            ]
        );

    endforeach; // foreach( $data['infras'] as $infraid => $infra ):

    if( isset( $data['ixpports'] ) ):
        $this->insert(
            "services/grapher/mrtg/target", [
                'trafficTypes' => \IXP\Utils\Grapher\Mrtg::TRAFFIC_TYPES,
                'mrtgPrefix'   => sprintf( "ixp%03d", $ixp->getId() ),
                'portIds'      => $data['ixpports'],
                'data'         => $data,
                'graphTitle'   => sprintf( config('identity.orgname') . " - %%s / second" ),
                'directory'    => sprintf( "ixp" ),
            ]
        );
    endif;
?>



#####################################################################################################################
#####################################################################################################################
#####################################################################################################################
