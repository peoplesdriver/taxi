<?php

class BrandController extends Controller
{
    public function showAdminBrands($request, $response, $args)
    {
        $this->view = '/admin/brands/list-brand.html.twig';
        $this->twig_vars['brands'] = Brand::paginate(10);
        $this->render();
    }

    public function showAdminBrand($request, $esponse, $args)
    {
        $this->view = '/admin/brands/form-brand.html.twig';
        $this->twig_vars['brand'] = Brand::find($args['id']);
        $this->twig_vars['filials'] = Filial::all();
        $this->twig_vars['regions'] = Region::all();
        $this->twig_vars['brandgroups'] = BrandGroup::all();
        $this->render();
    }

    public function addAdminBrand($request, $response, $args)
    {
        $this->view = '/admin/brands/form-brand.html.twig';
        $this->twig_vars['filials'] = Filial::all();
        $this->twig_vars['regions'] = Region::all();
        $this->twig_vars['brandgroups'] = BrandGroup::all();
        $this->render();
    }

    public function createBrand($request, $response, $args)
    {
        $data = $request->getParams();
        Brand::create($data['brand']);
        return $response->withRedirect($this->ci->router->pathFor('brand.showAdminBrands'));
    }

    public function updateBrand($request, $response, $args)
    {
        $data = $request->getParams();
        Brand::find($args['id'])->update($data['brand']);
        return $response->withRedirect($this->ci->router->pathFor('brand.showAdminBrands'));
    }

    public function deleteBrand($request, $response, $args)
    {
        Brand::destroy($args['id']);
        return $response->withRedirect($this->ci->router->pathFor('brand.showAdminBrands'));
    }
}