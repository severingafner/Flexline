using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(Flexline.Startup))]
namespace Flexline
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
