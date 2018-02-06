import { TMadminPage } from './app.po';

describe('tmadmin App', () => {
  let page: TMadminPage;

  beforeEach(() => {
    page = new TMadminPage();
  });

  it('should display welcome message', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('Welcome to app!');
  });
});
